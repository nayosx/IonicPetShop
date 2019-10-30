import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { ProductServiceProvider } from '../../providers/product-service/product-service';
import { ProductDetailPage } from '../product-detail/product-detail';

/**
 * Generated class for the ProductPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

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
    this.pets = this.petsService.getProducts();
  }

  public showDetailPet(pet) {
    this.navCtrl.push(ProductDetailPage, {'pet': pet});
  }

}


