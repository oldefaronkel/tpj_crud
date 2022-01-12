<!--Splitting the header and footer into separate documents makes things easier!-->
<?php
$pageName = "Admin | Users";
include_once 'header.admin.php';
?>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3><?= $pageName ?></h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Starter Kit</a></li>
            <li class="breadcrumb-item active">Start</li>
          </ol>
        </div>
        <!-- Bookmark Start
        <div class="col-sm-6">
          <div class="bookmark">
            <ul>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
              <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                <form class="form-inline search-form">
                  <div class="form-group form-control-search">
                    <input type="text" placeholder="Search..">
                  </div>
                </form>
              </li>
            </ul>
          </div>
        </div>
        Bookmark Ends-->
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row starter-main">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>Kick start your project development !</h5>
          </div>
          <div class="card-body">
            <p>Getting start with your project custom requirements using a ready template which is quite difficult and time taking process, viho Admin provides useful features to kick start your project development with no efforts !</p>
            <ul>
              <li>
                <p>viho Admin provides you getting start pages with different layouts, use the layout as per your custom requirements and just change the branding, menu & content.</p>
              </li>
              <li>
                <p>Every components in viho Admin are decoupled, it means use only components you actually need! Remove unnecessary and extra code easily just by excluding the path to specific SCSS, JS file.</p>
              </li>
              <li>
                <p>It use PUG as template engine to generate pages and whole template quickly using node js. Save your time for doing the common changes for each page (i.e menu, branding and footer) by generating template with pug.</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>What is starter kit ?</h5>
            <div class="setting-list">
              <ul class="list-unstyled setting-option">
                <li>
                  <div class="setting-primary"><i class="icon-settings"></i></div>
                </li>
                <li><i class="view-html fa fa-code font-primary"></i></li>
                <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                <li><i class="icofont icofont-error close-card font-primary"></i></li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <p>Starter kit is a set of pages with different layouts, useful for your next project to start development process from scratch with no time.</p>
            <ul>
              <li>
                <p>Each layout includes basic components only.</p>
              </li>
              <li>
                <p>Select your choice of layout from starter kit, customize it with optional changes like colors and branding, add required dependency only.</p>
              </li>
              <li>
                <p>Using template engine to generate whole template quickly with your selected layout and other custom changes. </p>
              </li>
            </ul>
            <div class="code-box-copy">
              <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head1" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
              <pre><code class="language-html" id="example-head1">&lt;!-- Cod Box Copy begin --&gt;
&lt;p&gt;Starter kit is a set of pages with different layouts, useful for your next project to start development process from scratch with no time. &lt;/p&gt;
&lt;ul&gt;
&lt;li&gt;&lt;p&gt;Each layout includes basic components only.&lt;/p&gt;&lt;/li&gt;
&lt;li&gt;&lt;p&gt;Select your choice of layout from starter kit, customize it with optional changes like colors and branding, add required dependency only.&lt;/p&gt;&lt;/li&gt;
&lt;li&gt;&lt;p&gt;Using template engine to generate whole template quickly with your selected layout and other custom changes.&lt;/p&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
            </div>
          </div>
        </div>
      </div>

      <?php if (isset($_SESSION["user"])) { ?>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Welcome</h5>
            </div>
            <div class="card-body">
              <h5>This is hidden data</h5>
              <p>You can only see this when logged in.</p>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card">
            <div class="card-header pb-0">
              <h5><?= $_SESSION['user']['Uid'] ?></h5>
            </div>
            <div class="card-body">
              
              <p>

                <?php
                if (isset($_SESSION["user"]) && $_SESSION["user"]["Role"] === "Admin") {
                  echo '<h5>Session info</h5><pre>' . print_r($_SESSION, true) . '</pre>';
                  echo '<h5>getUserData</h5><pre>' . print_r(getUserData($conn, $_SESSION['user']['UUID']), true) . '</pre>';
                } else {
                  echo "<h5>Bla bla</h5>";
                }
                ?>

              </p>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>
<!-- footer start-->

<?php
include_once 'footer.admin.php';
?>