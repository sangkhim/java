package com.sangkhim.spring.service;

import java.util.List;
import java.util.Map;

import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestParam;

import com.sangkhim.spring.base.DataTable;
import com.sangkhim.spring.base.message.ResponseMessage;
import com.sangkhim.spring.domain.Product;

public interface ProductService {
	
	public DataTable dt(@RequestParam Map<String, String> param);
	
	public ResponseMessage<List<Product>> products();
	
	public ResponseMessage<Product> product(@PathVariable("productId") int productId);
	
	public ResponseMessage<String> insert(@ModelAttribute Product product);
	
	public ResponseMessage<String> update(@ModelAttribute Product product);
	
	public ResponseMessage<String> delete(@PathVariable("productId") int productId);
	
	public ResponseMessage<String> updateIsOnline(@PathVariable("productId") int productId, @PathVariable("isOnline") int isOnline);
	
}