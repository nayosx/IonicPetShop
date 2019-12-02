import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import * as environment from '../../shared/environment';
import { CarServiceProvider } from '../../providers/car-service/car-service';
import { StorageProvider } from '../../providers/storage/storage';
import { OrderDetailPage } from '../order-detail/order-detail';

@IonicPage()
@Component({
  selector: 'page-active-orders',
  templateUrl: 'active-orders.html',
})
export class ActiveOrdersPage {
  public idUser = 0;
  public orders = [];

  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams,
    public carService: CarServiceProvider, 
    private storage: StorageProvider,
    public toast: ToastController,
    ) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ActiveOrdersPage');
    this.storage.get('idUser').then(result => {
      if (result != null) {
        this.idUser = result;
        console.log('idUser: '+ result);
        this._getOrdenes();
      }
      }).catch(e => {
        console.log('error: '+ e);
    });
  }

  private _getOrdenes() {
    this.carService.getOrdenes(this.idUser).subscribe(
      result => {
        if(result.status) {
          let i = 1;
          let data = result.data.map(item => {
            item.localPath = environment.LOCAL_IMG;
            item.img = 'shopping.png';
            item.i = i;
            i++;
            return item;
          });
          this.orders = data;
          console.log(result);
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

  public doRefresh(event) {
    this._getOrdenes();
    setTimeout(() => {
      event.complete();
    }, 2000);
  }

  public showDetail(order) {
    this.navCtrl.push(OrderDetailPage, {'order': order});
  }
}
