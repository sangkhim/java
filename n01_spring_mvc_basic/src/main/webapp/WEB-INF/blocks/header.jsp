<%@ page session="false" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ taglib uri="http://www.springframework.org/tags" prefix="spring" %>
<%@ taglib uri="http://www.springframework.org/tags/form" prefix="form" %>

<div class="header clearfix">
  <nav>
    <ul class="nav nav-pills float-right">
      <li class="nav-item">
        <a class="nav-link <c:if test="${pageName == 'index'}">active</c:if>" href="<c:url value='/' />">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <c:if test="${pageName == 'about'}">active</c:if>" href="<c:url value='/about' />">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <c:if test="${pageName == 'contact'}">active</c:if>" href="<c:url value='/contact' />">Contact</a>
      </li>
    </ul>
  </nav>
  <h3 class="text-muted">Spring MVC</h3>
</div>