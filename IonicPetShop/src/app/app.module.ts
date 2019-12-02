import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';

import { HttpClientModule } from '@angular/common/http'; 

import { MyApp } from './app.component';
import { HomePage } from '../pages/home/home';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

import { AutorPage } from '../pages/autor/autor';
import { AutorServiceProvider } from '../providers/autor-service/autor-service';

import { ProductsPage } from '../pages/products/products';
import { ProductDetailPage } from '../pages/product-detail/product-detail';
import { ProductServiceProvider } from '../providers/product-service/product-service';

import { ActiveOrdersPage } from '../pages/active-orders/active-orders';
import { AboutAppPage } from '../pages/about-app/about-app'; 

import { LoginPage } from '../pages/login/login';
import { LoginServiceProvider } from '../providers/login-service/login-service';
import { CarServiceProvider } from '../providers/car-service/car-service';
import { IonicStorageModule } from '@ionic/storage';
import { StorageProvider } from '../providers/storage/storage';
import { OrderDetailPage } from '../pages/order-detail/order-detail';
@NgModule({
  declarations: [
    MyApp,
    HomePage,
    AutorPage,
    ProductsPage,
    ProductDetailPage,
    ActiveOrdersPage,
    AboutAppPage,
    LoginPage,
    OrderDetailPage
  ],
  imports: [
    BrowserModule,
    IonicModule.forRoot(MyApp),
    HttpClientModule,
    IonicStorageModule.forRoot()
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    AutorPage,
    ProductsPage,
    ProductDetailPage,
    ActiveOrdersPage,
    AboutAppPage,
    LoginPage,
    OrderDetailPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    AutorServiceProvider,
    ProductServiceProvider,
    LoginServiceProvider,
    CarServiceProvider,
    StorageProvider
  ]
})
export class AppModule {}
