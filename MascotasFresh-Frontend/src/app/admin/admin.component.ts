import { Component, OnInit } from '@angular/core';
import { ServiciosService } from '../servicios.service';
import { FormBuilder,Validators } from '@angular/forms';



@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit {

  constructor(private servicios:ServiciosService,
              private formBuilder: FormBuilder) { }
  
  userForm = this.formBuilder.group({
    name:['',Validators.required],
    email:['',Validators.required, , Validators.required],
    password:['',Validators.required],
    password_confirmation:['',Validators.required],
    rol_id: ['',Validators.required],
  });

  usuarios:any=[];

  ngOnInit(): void {
    this.getUsuarios();

  }

  getUsuarios() {
    this.servicios
        .getUsers().subscribe((data:any=[])=>{
          this.usuarios = data.usuarios;  
          console.log(this.usuarios);            
        })  
  }
  saveUsuario() {
    console.log(this.userForm);
    this.servicios
        .addUsuario(this.userForm.value).subscribe((response:any)=> {
          alert(JSON.stringify(response))
          this.getUsuarios();
        });
  }

}
