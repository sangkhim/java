package com.sangkhim.spring.domain;

import org.springframework.web.multipart.MultipartFile;

public class Contact {
	String id;
	String photo;
	String name;
	String city;
	String tel;
	String email;
	String emailMd5;
	MultipartFile file;
	
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public String getPhoto() {
		return photo;
	}
	public void setPhoto(String photo) {
		this.photo = photo;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public String getCity() {
		return city;
	}
	public void setCity(String city) {
		this.city = city;
	}
	public String getTel() {
		return tel;
	}
	public void setTel(String tel) {
		this.tel = tel;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}	
	public String getEmailMd5() {
		return emailMd5;
	}
	public void setEmailMd5(String emailMd5) {
		this.emailMd5 = emailMd5;
	}
	public MultipartFile getFile() {
		return file;
	}
	public void setFile(MultipartFile file) {
		this.file = file;
	}
	
	@Override
	public String toString() {
		return "Contact [id=" + id + ", photo=" + photo + ", name=" + name + ", city=" + city + ", tel=" + tel
				+ ", email=" + email + ", emailMd5=" + emailMd5 + ", file=" + file + "]";
	}
		
}
