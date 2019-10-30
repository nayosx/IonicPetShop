import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { AutorServiceProvider } from '../../providers/autor-service/autor-service';

/**
 * Generated class for the AutorPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-autor',
  templateUrl: 'autor.html',
})
export class AutorPage {
  public aboutMe: any = {};
  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams,
    public autorService: AutorServiceProvider) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AutorPage');
    this.aboutMe = this.autorService.getAutor();
  }

}
