package com.sangkhim.spring.controller.rest;

import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.sangkhim.spring.base.DataTable;
import com.sangkhim.spring.base.message.ResponseMessage;
import com.sangkhim.spring.domain.Product;
import com.sangkhim.spring.service.ProductService;

@RestController
@RequestMapping("/api/admin")
public class ProductRestController {
	
	@Autowired 
	ProductService productService;
	
	@RequestMapping( value = "/products/dt", method = RequestMethod.GET )
	public DataTable dt(@RequestParam Map<String, String> param){		
		return productService.dt(param);
	}
	
	@RequestMapping(value = {"/public/products", "/products"}, method = RequestMethod.GET)
	public ResponseMessage<List<Product>> products() {
		return productService.products();
	}

	@RequestMapping(value = {"/public/products/{productId}", "/products/{productId}"}, method = RequestMethod.GET)
	public ResponseMessage<Product> product(@PathVariable("productId") int productId) {
		return productService.product(productId);
	}
	
	@RequestMapping(value = {"/public/products", "/products"}, method = RequestMethod.POST)
	public ResponseMessage<String> insert(@ModelAttribute Product product) {
		return productService.insert(product);
	}	

	@RequestMapping(value = {"/public/update-products", "/update-products"}, method = RequestMethod.POST)
	public ResponseMessage<String> update(@ModelAttribute Product product) {
		return productService.update(product);
	}	
	
	@RequestMapping(value = {"/public/delete-products/{productId}", "/delete-products/{productId}"}, method = RequestMethod.POST)
	public ResponseMessage<String> delete(@PathVariable("productId") int productId) {
		return productService.delete(productId);
	}
	
	@RequestMapping(value = {"/public/products/{productId}/onlines/{isOnline}", "/products/{productId}/onlines/{isOnline}"}, method = RequestMethod.POST)
	public ResponseMessage<String> updateIsOnline(@PathVariable("productId") int productId, @PathVariable("isOnline") int isOnline) {
		return productService.updateIsOnline(productId, isOnline);
	}

}