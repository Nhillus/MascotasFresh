import { Component, OnInit } from '@angular/core';
import { ServiciosService } from '../servicios.service';
@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  title = 'MascotasFresh-Frontend';
  constructor(private servicios: ServiciosService) {
  }

  logeado = false;
  notificaciones:any=[];


  ngOnInit() {
    this.logeado = localStorage.getItem('token') !== null; //significa que estamos logeado hasta que el token sea retirado del localstorage
    this.getNotifications();
  }

  logout() {
    localStorage.removeItem('token');
  }

  getNotifications() {
    this.servicios
        .getNotificaciones().subscribe((data:any=[])=>{
          this.notificaciones = data.notifications;
          console.log(this.notificaciones);
          console.log(data);
        })
  }
}
