import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';

import { MyApp } from './app.component';
import { HomePage } from '../pages/home/home';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

import { PetsServiceProvider } from '../providers/pets-service/pets-service';
import { AutorPage } from '../pages/autor/autor';
import { AutorServiceProvider } from '../providers/autor-service/autor-service';

import { ProductsPage } from '../pages/products/products';
import { ProductDetailPage } from '../pages/product-detail/product-detail';
import { ProductServiceProvider } from '../providers/product-service/product-service';

import { ActiveOrdersPage } from '../pages/active-orders/active-orders';

@NgModule({
  declarations: [
    MyApp,
    HomePage,
    AutorPage,
    ProductsPage,
    ProductDetailPage,
    ActiveOrdersPage
  ],
  imports: [
    BrowserModule,
    IonicModule.forRoot(MyApp),
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    AutorPage,
    ProductsPage,
    ProductDetailPage,
    ActiveOrdersPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    PetsServiceProvider,
    AutorServiceProvider,
    ProductServiceProvider
  ]
})
export class AppModule {}
