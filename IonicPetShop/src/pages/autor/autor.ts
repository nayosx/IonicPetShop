import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { AutorServiceProvider } from '../../providers/autor-service/autor-service';
import * as environment from '../../shared/environment';

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
    public autorService: AutorServiceProvider
    ) {
      this.aboutMe = {
        image: 'logo.png',
        name: '',
        carnet: '',
        email: '',
        localPath: environment.LOCAL_IMG
      };
  }

  ionViewDidLoad() {
    this.autorService.getAutor().subscribe(
      result => {
        let autor = result.data;
        autor.localPath = environment.API_ENDPOINT.concat('public/img/');
        this.aboutMe = result.data;
      },
      error => {}
    );
  }

}
