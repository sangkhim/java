import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';

import {ContactService} from "../../swagger";

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  result = 0;

  constructor(public navCtrl: NavController, public contactService: ContactService) {

    this.contactService.testRequestParam(5, 10).subscribe((result) => {
      this.result = Number(result);
    });

  }

}
