import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders} from '@angular/common/http';
import { FormBuilder } from '@angular/forms';






const API_URL: string = 'http://localhost:8000/api';

@Injectable({
  providedIn: 'root',
  

})

export class ServiciosService {
  user:any;
 
  constructor(private http: HttpClient) { 
  }

  getAnimal() {
    return this.http.get(API_URL+'/animales');
  }


  addAnimal(animal:any) {
    return this.http.post(API_URL+'/agregaranimal', animal);
  }

  editarAnimal(animal:any){
    return this.http.put(API_URL+'/modificaranimal', animal);
    
  }

  eliminarAnimal(id:any){
    return  this.http.delete(API_URL+'/eliminaranimal'+'/'+id);

  }
  
  addCita(cita:any) {
    return this.http.post(API_URL+'/agregarcita', cita);
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
    return this.http.get(API_URL+'/serviciosDisponibles');
  }

  getUsers() {
    return this.http.get(API_URL+'/users');
  }
  addUsuario(user:any) {
    return this.http.post(API_URL+'/newuser', user);
  }

}
