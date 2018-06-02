package com.sangkhim.spring.controller.view;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

@Controller
public class ProductViewController {	
	
	@RequestMapping(value = "/admin/product_list", method = RequestMethod.GET)
	public String productList(Model model) {
		model.addAttribute("pageName", "product_list");
		return "layouts/admin";
	}
	
	@RequestMapping(value = "/admin/product_grid", method = RequestMethod.GET)
	public String productGrid(Model model) {
		model.addAttribute("pageName", "product_grid");
		return "layouts/admin";
	}
	
	@RequestMapping(value = "/admin/product_add", method = RequestMethod.GET)
	public String productAdd(Model model) {
		model.addAttribute("pageName", "product_add");
		return "layouts/admin";
	}
	
	@RequestMapping(value = "/admin/product_edit/{productId}", method = RequestMethod.GET)
	public String productEdit(Model model, @PathVariable("productId") String productId) {
		model.addAttribute("productId", productId);
		model.addAttribute("pageName", "product_edit");
		return "layouts/admin";
	}
	
	@RequestMapping(value = "/admin/product_detail/{productId}", method = RequestMethod.GET)
	public String productDetail(Model model, @PathVariable("productId") String productId) {		
		model.addAttribute("productId", productId);		
		model.addAttribute("pageName", "product_detail");
		return "layouts/admin";
	}

}