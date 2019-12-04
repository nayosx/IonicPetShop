import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import * as environment from '../../shared/environment';
import { CarServiceProvider } from '../../providers/car-service/car-service';
import { StorageProvider } from '../../providers/storage/storage';

@IonicPage()
@Component({
  selector: 'page-product-detail',
  templateUrl: 'product-detail.html',
})
export class ProductDetailPage {

  public pet: any = {
  };

  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams, 
    public carService: CarServiceProvider, 
    private storage: StorageProvider,
    public toast: ToastController,
    ) {
  }

  ionViewDidLoad() {
    this.pet = this.navParams.get('pet');
    this.storage.get('idUser').then(result => {
      if (result != null) {
        this.pet.idUser = result;
        console.log('idUser: '+ result);
      }
      }).catch(e => {
        console.log('error: '+ e);
    });
  }

  public addToCar(event) {
    let car = {
      iduser: this.pet.idUser, 
      idproduct: this.pet.id
    };

    this.carService.post(car).subscribe(
      result => {
        if(result.status) {
          this.showToast(result.msg);
        } else {
          this.showToast(result.msg);
        }
      },
      error => {
        this.showToast(environment.MSG.ERROR);
      }
    );
  }

  async showToast(msg) {
    const toast = await this.toast.create({
      message: msg,
      duration: 2000
    });
    toast.present();
  }
}
