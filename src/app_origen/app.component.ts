import { Component } from '@angular/core';
import { Ng2SmartTableModule } from 'ng2-smart-table';
import { LocalDataSource } from 'ng2-smart-table';
import { DatosService } from './services/datos.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'app works!';
  
  source: LocalDataSource = new LocalDataSource();
  settings = {
    edit: {
      // editButtonContent: '',
      // createButtonContent: '',
      // cancelButtonContent: '',
      confirmSave: true,
    },
    noDataMessage: 'No hay datos disponobles',
    actions: {
      columnTitle: 'Acciones',
      actions: {
        add: true,
        edit: true,
        delete: false
      }
    },
    pager: {
      perPage: 22,
      display: true
    },
    columns: {
      id: {
        title: 'ID'
      },
      name: {
        title: 'Nombre'
      },
      email: {
        title: 'Mail'
      }
    }
  }
  data = [
    {
      id: 1,
      name: 'Jorge',
      email: 'jorge@mail.com'
    },
    {
      id: 2,
      name: 'Pepe',
      email: 'pepe@mail.com'
    },
    {
      id: 3,
      name: 'Carlos',
      email: 'carlos@mail.com'
    }
  ];

  constructor ( public datos: DatosService )
  {
    // Carga alternativa
    // this.source.load(this.data);
    console.log(this.data);
    datos.traerDatos()
    .then(data => {
      console.log(data);
      this.source.load(data);
    })
  }

  editar ( e )
  {
    console.log(e);
  }
}
