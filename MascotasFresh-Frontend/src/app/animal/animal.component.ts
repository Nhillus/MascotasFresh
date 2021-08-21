import { Component, OnInit, Input } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { ServiciosService } from '../servicios.service';
import { DatepickerAdapterComponent } from '../datepicker-adapter/datepicker-adapter.component';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { error } from 'protractor';
import { Router } from '@angular/router';

@Component({
  selector: 'app-animal',
  templateUrl: './animal.component.html',
  styleUrls: ['./animal.component.css']
})
export class AnimalComponent implements OnInit {
  items:string='';

  addItem(newItem: string) {
    this.items=newItem;
    console.log(this.items);

  }





 

  checkoutForm = this.formBuilder.group({
    especie: '',
    raza: '',
    nombre: '',
    nacimiento: this.items,
    esterilizado: '',
  });

  //@Input() valuee:string;

  X:string='NATTY';

  animales:any=[];

  user: {
    name:any,
    email:any,
  };


  constructor(private servicios:ServiciosService,
              private formBuilder: FormBuilder, 
              private http: HttpClient,
              private router: Router) {
   
  }

  ngOnInit(): void {
    let headers = new HttpHeaders({
      'Authorization':`Bearer ${localStorage.getItem('token')}`,
      'Access-Control-Allow-Origin': 'http://localhost:8000',
      'Access-Control-Allow-Credentials':'true',
    });
    let options = { headers: headers };    
    this.http.get('http://localhost:8000/api/user', options).subscribe((
      (response:any) => 
          this.user = response
      ),
      err=> {
        localStorage.removeItem('token');
        this.router.navigate(['login']);
      }
    );
    this.getAnimales();
  }

  getAnimales() {
    this.servicios
        .getAnimal().subscribe((data:any=[])=>{
          this.animales = data.animales;              
        })  
  }
      
  addAnimal(): void{
    console.log(this.items);
    
    let value= this.checkoutForm.get('especie').value;
    this.checkoutForm.controls['nacimiento'].setValue(this.items);



    this.servicios.addAnimal(this.checkoutForm.value).subscribe((response:any)=>{
    alert(JSON.stringify(response)) 
    this.getAnimales();
    });
  }

  valueResponse(respuesta:any) {
    alert(respuesta);
   }


}
