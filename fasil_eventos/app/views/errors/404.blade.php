 <!DOCTYPE html>
 <html>
 <head>
 <title>404</title>
 	 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{asset('styles/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{asset('styles/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
 </head>
 <body>
 <div class="row">
        <div class="col s12 m12 l12">
          <div class="card blue">
            <div class="card-content white-text">
            <h1>404</h1>
              <span class="card-title">Tigo</span>
              <h2 class="flow-text">Sorry, La pagina no a sido encontrada</h2>
              <h1>:(</h1>
            </div>
            <div class="card-action">
               <a href="{{ URL::previous() }}">Volver</a>
            </div>
          </div>
        </div>
      </div>
 </body>
 </html>

	
 
