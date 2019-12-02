import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import { Validators, FormBuilder, FormGroup } from '@angular/forms';
import { HomePage } from '../home/home';
import { LoginServiceProvider } from '../../providers/login-service/login-service';
import * as environment from '../../shared/environment';
import { StorageProvider } from '../../providers/storage/storage';

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {

  public formLogin: FormGroup; //variable que se usa para gestionar el formulario de login

  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams,
    public formBuilder: FormBuilder, // el builder de los campos del formulario
    public toast: ToastController, //variable que controlara los mensajes
    public loginService: LoginServiceProvider,
    private storage: StorageProvider
    ) {
      this._prepareFormForBasicValidation();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
  }

  /**
   * Este metodo es usado para mostrar la alerta de tipo toast que mostrara el mensaje que le indiquemos
   * @param msg string
   */
  async showToast(msg) {
    const toast = await this.toast.create({
      message: msg,
      duration: 2000
    });
    toast.present();
  }

  /**
   * Este metodo inicializa las validaciones basicas del formulario de login con la ayuda del builder
   */
  private _prepareFormForBasicValidation() {
    this.formLogin = this.formBuilder.group({
      username: ['', [Validators.required, Validators.minLength(2)]],
      password: ['', [Validators.required, Validators.minLength(2)]]
    });
  }

  /**
   * Cuando se rellena el formulario, se hace uso de este metodo que valida y hace un fake de login,
   * el cual setea al componente HomePage por defecto. Ademas imprime los datos capturados en la consola
   */
  public doLogin() {
    let login = this.formLogin.value; //captura la data del formulario

    this.loginService.post(login).subscribe(
      result => {
        if(result.status) {
            //this.storage.remove('idUser');

            //this.storage.set('idUser', result.data.id);

            //this.setStorage('idUser', result.data.id);

            //this.getStorage('idUser');

            this.storage.set('idUser', result.data.id).then(result => {
              console.log('Data is saved');
            }).catch(e => {
              console.log("error: " + e);
            });

            this.navCtrl.setRoot(HomePage);
        } else {
          this.showToast(result.msg);
        }
      },
      error => {
        this.showToast(environment.MSG.ERROR);
      },
      () => {}
    );

  }
}
