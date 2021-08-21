import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css']
})
export class RegistroComponent implements OnInit {
  form: FormGroup;


  constructor(private fb:FormBuilder,
              private http:HttpClient,
              private router:Router) { }

  ngOnInit(): void {
      if (localStorage.getItem("token") === null)
      {
        this.form = this.fb.group( {
          name:['',Validators.required],
          email:['',Validators.required, , Validators.required],
          password:['',Validators.required],
          password_confirmation:['',Validators.required],
        });
      }
      else
      this.router.navigate(['animal']);
  }

  register() {
    let formData = this.form.getRawValue();
    console.log(formData);
    this.http.post('http://localhost:8000/api/registro',formData).subscribe(
        response => console.log(response),
        err => console.log(err)
      );

  }

}
