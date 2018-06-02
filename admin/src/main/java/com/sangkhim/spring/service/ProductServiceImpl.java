package com.sangkhim.spring.service;

import java.util.ArrayList;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.userdetails.User;
import org.springframework.stereotype.Service;
import org.springframework.util.Base64Utils;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;

import com.sangkhim.spring.base.DataTable;
import com.sangkhim.spring.base.FileUploadUtils;
import com.sangkhim.spring.base.message.ResponseMessage;
import com.sangkhim.spring.base.message.ResponseMessageUtils;
import com.sangkhim.spring.domain.Product;
import com.sangkhim.spring.domain.ProductImage;
import com.sangkhim.spring.mapper.ProductMapper;
import com.sangkhim.spring.security.UserAuthSession;

@Service
public class ProductServiceImpl implements ProductService {
	
	@Autowired
	ProductMapper productMapper;
	
	public DataTable dt(@RequestParam Map<String, String> param) {
		DataTable dataTable = new DataTable(param);		
		Product product = new Product();
		product.setStart(dataTable.getStart());
		product.setLength(dataTable.getLength());
		
		ArrayList<String> searchBy = new ArrayList<String>();
		ArrayList<String> searchColumnsValue = new ArrayList<String>();
		int index = 0;
		for(String item : dataTable.getSearchColumnsValue()){
			if (!item.equalsIgnoreCase("")) {
				searchBy.add(dataTable.getNameColumns().get(index));
				searchColumnsValue.add(item);
			}
			index++;
		}
		product.setSearchBy(searchBy);
		product.setSearchKeyword(searchColumnsValue);
		
		product.setSortColumn(dataTable.getOrderColumnsName());
		product.setSortDir(dataTable.getOrderDirs());
		
		List<Product> list;
		Long listCount = productMapper.getListCount(product);
		Long searchListCount = 0L;
		
		if(product.getSearchBy().size() > 0){
			list = productMapper.getSearchList(product);
			searchListCount = productMapper.getSearchListCount(product);
			dataTable.setResponse(listCount, searchListCount, list, "");
		}else{
			list = productMapper.getList(product);
			dataTable.setResponse(listCount, listCount, list, "");
		}		
		
		return dataTable;
	}
	
	public ResponseMessage<List<Product>> products() {
		User userAuth = UserAuthSession.getUserAuth();
		if(userAuth != null) {
			System.out.println(userAuth.toString());
		}
		
		List<Product> productList = productMapper.getAll();
		return ResponseMessageUtils.makeSuccessResponse(productList);
	}
	
	public ResponseMessage<Product> product(@PathVariable("productId") int productId) {
		Product product = productMapper.getById(productId);
		return ResponseMessageUtils.makeSuccessResponse(product);
	}
	
	public ResponseMessage<String> insert(@ModelAttribute Product product) {
		product.setCreatedBy(1);
		productMapper.insert(product);
		
		if(product.getProductImageList() != null) {
			for(int i=0; i < product.getProductImageList().size(); i++) {
				ProductImage productImage = product.getProductImageList().get(i);
				MultipartFile file = productImage.getFile();
				if(file != null && file.getSize() > 0) {
					String image = FileUploadUtils.saveFileUploaded(file);
					productImage.setSrc(image);
					
					productImage.setProductId(product.getProductId());
					productImage.setSortOrder(productImage.getSortOrder());
					productMapper.insertProductImage(productImage);
				}else if(productImage.getFileBase64() != null) {
					byte[] byteArray = Base64Utils.decodeFromString(productImage.getFileBase64()); 
					String image = FileUploadUtils.saveFileUploadedFromByteArray(byteArray);
					productImage.setSrc(image);
					
					productImage.setProductId(product.getProductId());
					productImage.setSortOrder(productImage.getSortOrder());
					productMapper.insertProductImage(productImage);
				}
			}
		}
		
		return ResponseMessageUtils.makeResponse(true, "Success");
	}
	
	public ResponseMessage<String> update(@ModelAttribute Product product) {
		product.setModifiedBy(1);
		productMapper.update(product);
		
		if(product.getProductImageList() != null) {
			for(int i=0; i < product.getProductImageList().size(); i++) {
				ProductImage productImage = product.getProductImageList().get(i);
				MultipartFile file = productImage.getFile();
				if(file != null && file.getSize() > 0) {
					String image = FileUploadUtils.saveFileUploaded(file);
					productImage.setSrc(image);
					
					productImage.setProductId(product.getProductId());
					productImage.setSortOrder(productImage.getSortOrder());
					productMapper.insertProductImage(productImage);
				}else if(productImage.getFileBase64() != null) {
					byte[] byteArray = Base64Utils.decodeFromString(productImage.getFileBase64());
					String image = FileUploadUtils.saveFileUploadedFromByteArray(byteArray);
					productImage.setSrc(image);
					
					productImage.setProductId(product.getProductId());
					productImage.setSortOrder(productImage.getSortOrder());
					productMapper.insertProductImage(productImage);
				}
			}
		}
		if(product.getDeleteProductImageList() != null) {
			for (int i = 0; i < product.getDeleteProductImageList().size(); i++) {
				ProductImage productImage = productMapper.getProductImageById(product.getDeleteProductImageList().get(i));
				FileUploadUtils.deleteFile(productImage.getSrc());
				productMapper.deleteProductImage(productImage.getProductImageId());
			}
		}
		
		return ResponseMessageUtils.makeResponse(true, "Success");
	}
	
	public ResponseMessage<String> delete(@PathVariable("productId") int productId) {
		if(productMapper.deleteById(productId) == 1){
			return ResponseMessageUtils.makeResponse(true, "Success");
		}else{
			return ResponseMessageUtils.makeResponse(false, "Fail");
		}
	}
	
	public ResponseMessage<String> updateIsOnline(@PathVariable("productId") int productId, @PathVariable("isOnline") int isOnline) {
		if(productMapper.updateIsOnline(productId, isOnline) == 1){
			return ResponseMessageUtils.makeResponse(true, "Success");
		}else{
			return ResponseMessageUtils.makeResponse(false, "Fail");
		}
	}
	
}