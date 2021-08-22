import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { ServiciosService } from '../servicios.service';



@Component({
  selector: 'app-cita',
  templateUrl: './cita.component.html',
  styleUrls: ['./cita.component.css']
})
export class CitaComponent implements OnInit {

  fecha:string=''; // va con fecha
  servicioSeleccionado:number=1;
  medicologueado:number=2;
  animalseleccionado:number=1;



  addItem(newItem: string) {
    this.fecha=newItem;
    console.log(this.fecha);

  }
  FormCita = this.formBuilder.group({
    servicio_id: this.servicioSeleccionado,
    animal_id: this.animalseleccionado,
    user_id: this.medicologueado,
    fecha: this.fecha,
    estatus: 'pendiente',

  });

  //servicio_id	animal_id	medico_id	fecha	estatus	

  constructor(private formBuilder: FormBuilder, private servicios:ServiciosService) { }

  user : {
    id:'',
    name:'',
    email:'',
  }
  

  ngOnInit(): void {
  }

  addCita(): void{
    console.log(this.fecha);
    
   // let value= this.FormCita.get('especie').value;
    this.FormCita.controls['fecha'].setValue(this.fecha);
    this.FormCita.controls['servicio_id'].setValue(this.servicioSeleccionado);
    this.FormCita.controls['user_id'].setValue(this.medicologueado);
    this.FormCita.controls['animal_id'].setValue(this.animalseleccionado);

    this.servicios.addCita(this.FormCita.value).subscribe((response:any)=>{
    alert(JSON.stringify(response)) 
    });
  }


}
