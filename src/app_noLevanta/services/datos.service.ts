import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

// import { Observable } from 'rxjs/Observable';
// import 'rxjs/add/operator/catch';
// import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class DatosService {

  constructor( public http: Http )
  {

  }
  
  traerDatos ()
  {
    let url ='http://localhost:8080/abm_apirest/apirest.php/traerTodos'; //ARRAY DELA WEB'https://restcountries.eu/rest/v2/all';
    return this.http
      .get( url )
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }

  private extractData ( res: Response )
  {
    return res.json() || {};
  }

  private handleError ( error: Response | any )
  {
    return error;
  }

}
