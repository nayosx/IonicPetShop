import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import * as environment from '../../shared/environment';
import { CarServiceProvider } from '../../providers/car-service/car-service';
import { StorageProvider } from '../../providers/storage/storage';

@IonicPage()
@Component({
  selector: 'page-order-detail',
  templateUrl: 'order-detail.html',
})
export class OrderDetailPage {

  public order = {};

  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams, 
    public carService: CarServiceProvider, 
    private storage: StorageProvider,
    public toast: ToastController,
  ) {
  }

  ionViewDidLoad() {
    this.order = this.navParams.get('order');
  }

  async showToast(msg) {
    const toast = await this.toast.create({
      message: msg,
      duration: 2000
    });
    toast.present();
  }

  public buy(event) {
    
  }
}
