import { Component, OnInit } from '@angular/core';
import { ServiciosService } from '../servicios.service';
import { FormBuilder,Validators } from '@angular/forms';
import { Router } from '@angular/router';




@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit {

  constructor(private servicios:ServiciosService,
              private formBuilder: FormBuilder,
              private router:Router) { }
  
  userForm = this.formBuilder.group({
    name:['',Validators.required],
    email:['',Validators.required, , Validators.required],
    password:['',Validators.required],
    password_confirmation:['',Validators.required],
    rol_id: ['',Validators.required],
  });

  user: {
    id:any,
    name:any,
    email:any,
  };

  usuarios:any=[];

  ngOnInit(): void {
    this.getUser();
    this.getUsuarios();

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
