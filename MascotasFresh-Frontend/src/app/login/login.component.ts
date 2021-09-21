import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder } from "@angular/forms";
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  form: FormGroup;

  constructor(private fb:FormBuilder,
              private http:HttpClient,
              private router: Router) {
    this.form = this.fb.group({
      email: '',
      password:'',
    })

  }

  ngOnInit(): void {
  }

  submit() {
    console.log(this.form.getRawValue());
    let formData = this.form.getRawValue(); //Consigue la dara del formulario login si esta tuviera campos desabilitados tambien la traeria, ojo con ellos en futuros usos
    let data = {                            //Creo La data que sera enviada al servidor, con su usuario y contraseña,ademas como usamos OAuth 2.0 dejamos en la data la forma
      username: formData.email,             //En que que nuestra aplicacion cliente consigue el access_token para estar autorizado a usar los endpoints del backend en este
      password: formData.password,          //En este caso por la palabra password, esta peticion es una de la mas simples con la contraseña que el usuario a dado pedimos al
      grant_type:'password',                //Servidor un intercambio un token de acceso por la contraseña,con el cliente_id identificamos la aplicacion que esta asociada al backend
      client_id: '2',                       //Como la aplicacion cliente es nuestra podemos colocar el client_secret en el caso de que fuera de 3eros deberiamos usar algun tipo de intercambio
      client_secret:'GADO8s5bg4aXI8mDnxXy9irWai8TKxsK4iiezGOm',       //Tal vez usando claves privadas con publicas (Nota para mi: recuerda seguridad wilmer claves privadas publicas)
    };
    let headers = new HttpHeaders({                                 //Aqui creamos un objecto Httpheaders el cual funciona la forma mas simple de explicarlo es como si de etiquetas en el correo
      'Access-Control-Allow-Origin': 'http://localhost:8000',       //Se trataran, Enviamos el access-controll el cual dice a que dirrecion va el paquete y que permita acceso por medio de credenciales
      'Access-Control-Allow-Credentials':'true',                    //Sin esto no podriamso acceder a las rutas o endpoints del backend en laravel ya que esta configurando para esperar estos valores
    });                                                             //Por medio de cors(Cross-Origin Resource Sharing) cuando tenemos dos aplicaciones back y front estas por medio de cors decimos que el contenido de esta pagina es accesible a determinados origenes
    let options = { headers: headers };                             // En el A.C.A.O(Access-Control-Allow-Origin) Podriamos colocarlo variable para una implementacion en un servidor como heroku o docker (Nota para mi: Hacer el cambio luego )
    this.http.post('http://localhost:8000/api/login',data,options).subscribe(  //Hacemos una peticion post con la data y con el header en options
      (response:any) => {
        console.log('succes');
        console.log(response);                                      //Si la repuesta es correcta del servidor, guardamos en el localStorage el token para verificar que el usuario es el correcto con su token y autorizarlo en su recorrido por la aplicacion y lo enviamos a su consultorio en linea
        localStorage.setItem('token',response.access_token);
        this.router.navigate(['/animal'])
      },
      error => {                                                    //Si no devuelve un error.
        console.log('error');
        console.log(error)
      }
    )
  }

}
