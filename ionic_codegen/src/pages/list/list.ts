import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import {ContactService} from "../../swagger";

@Component({
  selector: 'page-list',
  templateUrl: 'list.html'
})
export class ListPage {
  
  list = [];

  constructor(public navCtrl: NavController, public contactService: ContactService) {

    this.contactService.getAll().subscribe((result) => {
      console.log(this.list);
      this.list = result;
    });

  }

}
