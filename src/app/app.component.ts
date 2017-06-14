import { Component } from '@angular/core';
import { PersonasService } from './servicios/personas.service';


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  
  title = 'app works!';
  banderaEditar;
  colorcito;
  datos={};
  personaAgregada;
  personas;
  mostrar:string = "Todos";
  visibilidad:string="visible";
  
  

  constructor (public datosPersonas:PersonasService  )
  {
    //console.info(datosPaises.traerTodosLosPaises());

    datosPersonas.traerTodasLasPersonas().then(varCallBack => this.personas = varCallBack);
    console.log(datosPersonas.traerTodasLasPersonas());

    // this.mostrar = {
    //         queMuestro: "todos"
    //     };
  }
// id` int(11) NOT NULL,
//   `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
//   `apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
//   `dni` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
//   `foto` v


  setearRutaFoto(data)
  {



    this.personas = data;
  }

 
}
