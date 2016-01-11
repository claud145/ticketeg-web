<?php namespace App\Services;

use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Illuminate\Contracts\Mail\MailQueue as MailQueueContract;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Illuminate\Mail\Message;
use Closure;
use InvalidArgumentException;
use Swift_Mailer;
use Swift_Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Aws\Ses\SesClient;

class CustomMailService implements MailerContract, MailQueueContract {
    
    public function send($view, array $data, $callback) {
        $message = new Message(new Swift_Message);
        
        if ($callback instanceof Closure) {
            // callback must assign $to and $subject, deal with it
            call_user_func($callback, $message); 
        } else {
            throw new InvalidArgumentException('Callback is not valid.');
        }

        $m = $message->getSwiftMessage();
        $filteredTo = array_filter(array_keys($message->getTo()), function($email) {
            $skip = DB::table('ses_feedback')->where('email', $email)->first();
            if ($skip) {
                Log::info("skipping email:$email");
            }
            return !$skip;
        });
        if ($filteredTo) {
            $converter = new CssToInlineStyles();
            $converter->setEncoding($message->getCharset());
            $converter->setStripOriginalStyleTags();
            $converter->setUseInlineStylesBlock();
            $converter->setExcludeMediaQueries(false);
            $converter->setCleanup();
            $converter->setHTML(View::make($view, $data)->render());
            $body = $converter->convert();
            
            $config = Config::get('services.amazon');
            SesClient::factory($config)->sendEmail(array(
                    // Source is required
                    'Source' => $config['from'],
                    // Destination is required
                    'Destination' => array(
                            'ToAddresses' => $filteredTo,
                            //'CcAddresses' => array('string', ... ),
                            //'BccAddresses' => array('string', ... ),
                    ),
                    // Message is required
                    'Message' => array(
                            // Subject is required
                            'Subject' => array(
                                    // Data is required
                                    'Data' => $m->getSubject(),
                                    'Charset' => 'UTF-8',
                            ),
                            // Body is required
                            'Body' => array(
                                    'Text' => array(
                                            // Data is required
                                            'Data' => strip_tags(str_replace("<br/>","\n", $body)),
                                            'Charset' => 'UTF-8',
                                    ),
                                    'Html' => array(
                                            // Data is required
                                            'Data' => $body,
                                            'Charset' => 'UTF-8',
                                    ),
                            ),
                    ),
                    'ReplyToAddresses' => array(),
                    //'ReturnPath' => 'string',
            ));
        }
    }
    
    public function raw($text, $callback) {
        Log::info("Expected to send raw email ?!");
    }
    
    public function failures() {
        Log::info('called to mail failures()');
    }

    public function queue($view, array $data, $callback, $queue = null) {
        Log::info("expected to queue email");
    }
    
    public function later($delay, $view, array $data, $callback, $queue = null) {
        Log::info("expected to send an email after $delay seconds delay");
    }
    
}