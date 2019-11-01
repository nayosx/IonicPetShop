import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';

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

@NgModule({
  declarations: [
    MyApp,
    HomePage,
    AutorPage,
    ProductsPage,
    ProductDetailPage,
    ActiveOrdersPage,
    AboutAppPage
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
    ActiveOrdersPage,
    AboutAppPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    AutorServiceProvider,
    ProductServiceProvider
  ]
})
export class AppModule {}
