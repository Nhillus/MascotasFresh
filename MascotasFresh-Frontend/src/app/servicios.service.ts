import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders} from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { User } from './user';

const API_URL: string = 'http://localhost:8000/api';
@Injectable({
  providedIn: 'root',
})

export class ServiciosService {
  user:User;

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

  getAnimalByDoc() {
    return this.http.get(API_URL+'/animalesByDoc',this.options);
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
    return this.http.get(API_URL+'/users', this.options);
  }
  addUsuario(user:any) {
    return this.http.post(API_URL+'/newuser', user, this.options);
  }
  editarUsuario(usuario:any) {
    return this.http.put(API_URL+'/modificaruser', usuario, this.options);
  }
  eliminarUsuario(id:any) {
    return this.http.delete(API_URL+'/eliminaruser'+'/'+id, this.options);
  }
  conseguirroles() {
    return this.http.get(API_URL+'/rolesavaliable',this.options);
  }
  getProductos() {
    return this.http.get(API_URL+'/products',this.options);
  }
  addProducto(producto:any) {
    return this.http.post(API_URL+'/newproducto', producto,this.options);
  }
  editarProducto(producto:any) {
    return this.http.put(API_URL+'/updateproducto', producto,this.options);
  }
  eliminarProducto(id:any) {
    return this.http.delete(API_URL+'/deleteproducto'+'/'+id,this.options);
  }
  getNotificaciones() {
    return this.http.get(API_URL+'/notifications',this.options);
  }
  getCitasByAnimal(id:number) {
    return this.http.get(API_URL+'/citasAnimal'+'/'+id,this.options);
  }
}
