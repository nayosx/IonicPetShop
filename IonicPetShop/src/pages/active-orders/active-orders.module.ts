import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { ActiveOrdersPage } from './active-orders';

@NgModule({
  declarations: [
    ActiveOrdersPage,
  ],
  imports: [
    IonicPageModule.forChild(ActiveOrdersPage),
  ],
})
export class ActiveOrdersPageModule {}
