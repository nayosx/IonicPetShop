import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { ProductServiceProvider } from '../../providers/product-service/product-service';
import { ProductDetailPage } from '../product-detail/product-detail';
import * as environment from '../../shared/environment';

@IonicPage()
@Component({
  selector: 'page-products',
  templateUrl: 'products.html',
})
export class ProductsPage {
  public pets: any[] = [];

  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams,
    public petsService: ProductServiceProvider) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad PetsPage');
    this._get();
    
  }

  public showDetailPet(pet) {
    this.navCtrl.push(ProductDetailPage, {'pet': pet});
  }

  private _get() {
    this.petsService.getProducts().subscribe(
      result => {
        if(result.status) {
          let data = result.data.map(item => {
            item.localPath = environment.API_ENDPOINT.concat('public/img/');
            return item;
          });
          this.pets = data;
        }
      },
      error => {}
    );
  }


  public doRefresh(event) {
    this._get();
    setTimeout(() => {
      event.complete();
    }, 2000);
  }

}


