import { Component, OnInit } from '@angular/core';
import { ServiciosService } from '../servicios.service';
import { FormBuilder } from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
import { Product } from '../product';
import { User} from '../user';


@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css']
})
export class ProductComponent implements OnInit {
  items:string='';
  campoNombre:string;
  campoCantidad:string;
  campoPrecio:string;
  campoLote:string;
  campoCreado:string;
  campoVencimiento:string;
  raza:string;
  productoseleccionado:Product;
  productos: Array<Product> = [];

  checkoutForm = this.formBuilder.group({
    nombre: '',
    cantidad: '',
    precio: '',
    lote: '',
    creado:'',
    vencimiento:'',
  });

  animales:any=[];

  user:User;

  constructor(private servicios:ServiciosService,
              private formBuilder: FormBuilder,
              private router:Router,
            ) {
  }

  ngOnInit(): void {
   this.getUser();
   this.getProductos();
  }

  getProductos() {
    this.servicios
        .getProductos()
        .subscribe((data:any=[Product])=>{
          this.productos = data.productos;
          console.log(this.productos);
        })
  }

  productoSeleccionado(producto:Product){
    this.productoseleccionado = producto;
    console.log(this.productoseleccionado);
  }

  eliminarProducto(producto) {
    console.log("entre eliminar")
    this.productoSeleccionado(producto)
    this.servicios
        .eliminarProducto(this.productoseleccionado.id)
        .subscribe((response:JSON)=>{
          alert(JSON.stringify(response))
          this.getProductos();
        });
  }

  modificarProducto() {
    console.log(this.productoseleccionado)
    this.servicios
        .editarProducto(this.productoseleccionado)
        .subscribe((response) => {
          this.productos.map(x => {
            if(x.id == this.productoseleccionado.id){
              x = this.productoseleccionado;
            }
          });
           alert(JSON.stringify(response))
          this.getProductos();
        }
        , (error) => {
          let errMsg = "Update Fail ! Error = " + error;
        });
  }

  addProducto(): void{
    console.log(this.checkoutForm.getRawValue());
    this.servicios.addProducto(this.checkoutForm.value).subscribe((response:JSON)=>{   //Llamo al servicio servicios con su metodo addAnimal el cual tiene toda la logica para enviar el http post al backend con su url y headder
      alert(JSON.stringify(response))
      this.getProductos();                                                   //llamo al metodo para actualizar la lista de animales desde el backend, tambien se podria hacer con los datos que tenemos en el formulario de animal
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



    search(campo,escritura) {                                                               //Este metodo hace una busqueda separada por campo entre los 4 campos del html(Especie,Raza,Nombre,Animal), lo hace
      if (this[escritura] != "") {                                                          //pasando el valor del campo que se esta buscando, con la "escritura" que es enviado dependiendo donde se escriba,
        this.productos = this.productos.filter(res => {                                         //la "escritura" es basicamente el nombre del campo esto se conoce como programacion funcional
        return res[campo].toLocaleLowerCase().match(this[escritura].toLocaleLowerCase());
      })
      } else if (this[escritura] == ""){
        this.getProductos();
      }

    }
}
