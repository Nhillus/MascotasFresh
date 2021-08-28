import { Component, OnInit, Output,Input, EventEmitter } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { ServiciosService } from '../servicios.service';
import { Router } from '@angular/router';



@Component({
  selector: 'app-cita',
  templateUrl: './cita.component.html',
  styleUrls: ['./cita.component.css']
})
export class CitaComponent implements OnInit {

  @Input() idanimalcita:any;

  serviciosdisponibles:any=[];

  fecha:string=''; // va con fecha
  servicioSeleccionado:number=0;
  medicologueado:number=0;
  animalseleccionado:number=0;

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

  constructor(private formBuilder: FormBuilder, private servicios:ServiciosService, private router:Router)  { }

  user : {
    id:'',
    name:'',
    email:'',
  }
  selectedTitle:any;

  ngOnInit(): void {
    
    this.getServicios()
    this.getUser();
  }

  addCita(): void{
    this.animalseleccionado=this.idanimalcita;
    console.log(this.animalseleccionado);
    console.log(this.fecha);
    this.selectedTitle = this.serviciosdisponibles[0].id;
   // let value= this.FormCita.get('especie').value;
    this.FormCita.controls['fecha'].setValue(this.fecha);
    this.FormCita.controls['servicio_id'];
    this.FormCita.controls['user_id'].setValue(this.user.id);
    this.FormCita.controls['animal_id'].setValue(this.animalseleccionado);

    this.servicios.addCita(this.FormCita.value).subscribe((response:any)=>{
    alert(JSON.stringify(response)) 
    });
  }

  getUser() {
    this.servicios.getUser().subscribe((
     (response:any) => {
         this.user = response,
         console.log(this.user);
        }
         
     ),
     
     err=> {
      console.log(err); 
      localStorage.removeItem('token');
      this.router.navigate(['login']);
     }
     
    )}
    
  getServicios() {
    this.servicios
        .getServicios().subscribe((data:any=[])=>{
          this.serviciosdisponibles = data.servicios;
          console.log(this.serviciosdisponibles)              
        })  
  }
}
