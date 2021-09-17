import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders} from '@angular/common/http';
import { FormBuilder } from '@angular/forms';

const API_URL: string = 'http://localhost:8000/api';
@Injectable({
  providedIn: 'root',
  

})

export class ServiciosService {
  user:any;

    headers = new HttpHeaders({
      'Accept':'application/json',
      'Authorization':`Bearer ${localStorage.getItem('token')}`,
    });
     options = { headers: this.headers }
 
  constructor(private http: HttpClient) { 
  }

  getAnimal() {
    return this.http.get(API_URL+'/animales',this.options);
  }


  addAnimal(animal:any) {
    return this.http.post(API_URL+'/agregaranimal', animal,this.options);
  }

  editarAnimal(animal:any){
    return this.http.put(API_URL+'/modificaranimal', animal,this.options);
    
  }

  eliminarAnimal(id:any){
    return  this.http.delete(API_URL+'/eliminaranimal'+'/'+id,this.options);

  }
  
  addCita(cita:any) {
    return this.http.post(API_URL+'/agregarcita', cita,this.options);
  }

  getUser(){
    let headers = new HttpHeaders({
      'Authorization':`Bearer ${localStorage.getItem('token')}`,
      'Access-Control-Allow-Origin': 'http://localhost:8000',
      'Access-Control-Allow-Credentials':'true',
    });
    let options = { headers: headers };    
    return this.http.get(API_URL+'/user', options);
  }

  getServicios(){
    return this.http.get(API_URL+'/serviciosDisponibles',this.options);
  }

  getUsers() {
    return this.http.get(API_URL+'/users',this.options);
  }
  addUsuario(user:any) {
    return this.http.post(API_URL+'/newuser', user,this.options);
  }

}
