import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { AutorServiceProvider } from '../../providers/autor-service/autor-service';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  public aboutMe: any = {};
  constructor(public navCtrl: NavController, public autorService: AutorServiceProvider) {

  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AutorPage');
    this.aboutMe = this.autorService.getAutor();
  }

}
