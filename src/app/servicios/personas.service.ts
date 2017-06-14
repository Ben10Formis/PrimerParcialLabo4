import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import 'rxjs/add/operator/toPromise';


@Injectable()
export class PersonasService {

  constructor(public http:Http) { }


  traerTodasLasPersonas()
   {
     let url = 'http://localhost:8080/abm_apirest/apirest.php/traerTodos';
      return this.http
        .get(url)
        .toPromise()
        .then(this.extraerDatos)
        .catch(this.error);
   }

  borrar()
   {
     let url = 'http://localhost:8080/abm_apirest/apirest.php/traerTodos';
      return this.http
        .get(url)
        .toPromise()
        .then(this.extraerDatos)
        .catch(this.error);
   }

 agregar()
   {
     let url = 'http://localhost:8080/abm_apirest/apirest.php/registro';
      return this.http
        .get(url)
        .toPromise()
        .then(this.extraerDatos)
        .catch(this.error);
   }


   private extraerDatos(res: Response)
    {
      return res.json();
      //return res.json || {};
    }
    private error(error:Response)
    {
      return error;
    }



}
