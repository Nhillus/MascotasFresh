import { Component, OnInit } from '@angular/core';
import { User } from '../user';
import { ServiciosService } from '../servicios.service';
import { Router } from '@angular/router';



@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  constructor(private servicios:ServiciosService,
              private router:Router) { }

  user: User;

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

  ngOnInit(): void {
    this.getUser();
  }

}
