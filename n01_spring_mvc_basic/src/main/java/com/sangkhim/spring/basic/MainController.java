package com.sangkhim.spring.basic;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.servlet.ModelAndView;

@Controller
public class MainController {
	
	@RequestMapping(value = {"/", "/index"}, method = RequestMethod.GET)
	public String index(Model model) {		
		model.addAttribute("pageName", "index");
		return "default"; 
	}
	
	@GetMapping("/about")
	public String about(Model model) {		
		model.addAttribute("pageName", "about");
		return "default"; 
	}
	
	@GetMapping("/contact")
	public ModelAndView contact(Model model) {				
		return new ModelAndView("default", "pageName", "contact"); 
	}
	
}
