import { Component, OnInit, Input } from '@angular/core';
import { ServiciosService } from '../servicios.service';


@Component({
  selector: 'app-historia',
  templateUrl: './historia.component.html',
  styleUrls: ['./historia.component.css']
})
export class HistoriaComponent implements OnInit {

  constructor( private servicios:ServiciosService) { }

  ngOnInit(): void {
    }


  idanimal:number;
  animalseleccionado:number=0;
  citas:any=[];

   getCitasPorAnimal(id:number) {
     this.animalseleccionado= id;
    console.log(this.animalseleccionado);
    this.servicios
        .getCitasByAnimal(this.animalseleccionado).subscribe((data:any=[])=>{
          this.citas = data.citas;
          console.log(this.citas);
          console.log(data);
        })
  }

}
