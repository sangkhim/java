package com.sangkhim.docker.controller;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class HomeRestController {

    @RequestMapping(value = {"/", "/docker"}, method = RequestMethod.GET)
    public String index() {
        return "Hello Docker";
    }

}
