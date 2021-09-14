import { Component, OnInit, } from '@angular/core';
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
  campoEspecie:string;
  campoRaza:string;
  campoNombre:string;
  campoNacimeiento:string;
  raza:string;
  animalseleccionado:any;
  animaless: Array<any> = [];

  addItem(newItem: string) {
    this.items=newItem;      //output que recibo del hijo hacia el padre (animal.component.ts)
    console.log(this.items);
  }

  checkoutForm = this.formBuilder.group({
    especie: '',
    raza: '',
    nombre: '',
    nacimiento: this.items,
    esterilizado:0 ,
  });
  animales:any=[];

  user: {
    id:any,
    name:any,
    email:any,
  };

  constructor(private servicios:ServiciosService,
              private formBuilder: FormBuilder,
              private http: HttpClient,
              private router:Router,
            ) {

  }

  ngOnInit(): void {
   this.getUser();
    this.getAnimales();
  }

  getAnimales() {
    this.servicios
        .getAnimal().subscribe((data:any=[])=>{
          this.animales = data.animales;
          console.log(this.animales);
        })
  }

  animalSeleccionado(anis:any){
    this.animalseleccionado = anis;
  }

  eliminarAnimal(animal) {
    console.log("entre eliminar")
    this.animalSeleccionado(animal)
    this.servicios
        .eliminarAnimal(this.animalseleccionado.id)
        .subscribe((response:any)=>{
          alert(JSON.stringify(response))
          this.getAnimales();
        });
  }

  modificarAnimal() {
    console.log(this.animalseleccionado)
    this.animalseleccionado.nacimiento= this.items;
    this.servicios
        .editarAnimal(this.animalseleccionado)
        .subscribe(() => {
          this.animaless.map(x => {
            if(x.id == this.animalseleccionado.id){
              x = this.animalseleccionado;
            }
          });
        }
        , (error) => {
          let errMsg = "Update Fail ! Error = " + error;
        });
  }

  addAnimal(): void{
    console.log(this.items);

    this.checkoutForm.controls['nacimiento'].setValue(this.items);      //Junto con el output que recibo del componente datepicker que es un componenten hijo de animal.component.ts, es decir se encuentra en una
                                                                        //Etiqueta datapicker como una etiqueta dentro de animal, en el momento que llamo a la funcion addAnimal esta linea en el formcontrol lo guarda
    this.servicios.addAnimal(this.checkoutForm.value).subscribe((response:any)=>{   //Llamo al servicio servicios con su metodo addAnimal el cual tiene toda la logica para enviar el http post al backend con su url y headder
    alert(JSON.stringify(response))
    this.getAnimales();                                                    //llamo al metodo para actualizar la lista de animales desde el backend, tambien se podria hacer con los datos que tenemos en el formulario de animal
    });
  }

  valueResponse(respuesta:any) {
    alert(respuesta);
   }

   getUser() {
     this.servicios.getUser().subscribe((
      (response:any) =>
          this.user = response

      ),
      err=> {
        localStorage.removeItem('token');
        this.router.navigate(['login']);
      }
     )
    }

     id_animal:number;

    seleccionado(animal:any){
      this.id_animal=animal;
      console.log(this.id_animal);
    }

    search(campo,escritura) {                                                               //Este metodo hace una busqueda separada por campo entre los 4 campos del html(Especie,Raza,Nombre,Animal), lo hace
      if (this[escritura] != "") {                                                          //pasando el valor del campo que se esta buscando, con la "escritura" que es enviado dependiendo donde se escriba,
        this.animales = this.animales.filter(res => {                                         //la "escritura" es basicamente el nombre del campo esto se conoce como programacion funcional
        return res[campo].toLocaleLowerCase().match(this[escritura].toLocaleLowerCase());
      })
      } else if (this[escritura] == ""){
        this.getAnimales();
      }

    }
}
