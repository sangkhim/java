package com.sangkhim.spring.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RestController;

import com.sangkhim.spring.domain.Contact;
import com.sangkhim.spring.service.ContactService;

@RestController
public class ContactRestController {

	@Autowired
	private ContactService contactService;

	@RequestMapping(value = "/contacts", method = RequestMethod.GET)
	public List<Contact> contacts() {
		List<Contact> contactList = contactService.getAll();
		return contactList;
	}

	@RequestMapping(value = "/contacts/{contactId}", method = RequestMethod.GET)
	public Contact contact(@PathVariable int contactId) {
		Contact contact = contactService.getById(contactId);
		return contact;
	}

	@RequestMapping(value = "/contacts", method = RequestMethod.POST)
	public int insert(@RequestBody Contact contact) {
		return contactService.insert(contact);
	}
	
	@RequestMapping(value = "/contact-form-datas", method = RequestMethod.POST)
	public int insertFormData(@ModelAttribute Contact contact) {
		return contactService.insert(contact);
	}

	@RequestMapping(value = "/contacts", method = RequestMethod.PUT)
	public int update(@RequestBody Contact contact) {
		return contactService.update(contact);
	}

	@RequestMapping(value = "/contacts/{contactId}", method = RequestMethod.DELETE)
	public int delete(@PathVariable int contactId) {
		return contactService.deleteById(contactId);
	}

}