<#import "/spring.ftl" as spring />

<div class="header clearfix">
  <nav>
    <ul class="nav nav-pills float-right">
      <li class="nav-item">
        <a class="nav-link active" href="<@spring.url '/'/>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<@spring.url '/about'/>">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<@spring.url '/contact'/>">Contact</a>
      </li>
    </ul>
  </nav>
  <h3 class="text-muted">Spring MVC</h3>
</div>