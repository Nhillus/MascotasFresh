import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import { FormBuilder } from '@angular/forms';





const API_URL: string = 'http://localhost:8000/api';

@Injectable({
  providedIn: 'root',
  

})




export class ServiciosService {
 
  constructor(private http: HttpClient) { 
  }
  
  


  getAnimal() {
    return this.http.get(API_URL+'/animales');
  }


  addAnimal(todo:any) {
    return this.http.post(API_URL+'/agregaranimal', todo);
  }

  editarAnimal(todo:any){
    return this.http.put(API_URL+'/modificaranimal', todo);
    
  }

  eliminarAnimal(id:any){
    return  this.http.delete(API_URL+'/eliminaranimal'+'/'+id);

  }

}
