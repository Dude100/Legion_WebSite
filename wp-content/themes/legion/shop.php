<?php /* Template Name: Shop Page */ ?>
<?php get_header(); ?>

<main class="col-md-8 col-md-offset-1" role="main">
    <!-- section -->
    <section class="background shop">

        <h1 class="text-center"><?php the_title(); ?></h1>

        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            <!-- article -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="col-xs-12">
                    <?php the_content(); ?>
                    <?php $allItemClasses = getAllItemClasses(); ?>
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <div class="panel-group" id="accordion">
                                <?php foreach ($allItemClasses as $key => $itemClasse) { ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#<?= $itemClasse["class_id"]; ?>"><?= $itemClasse["name"]; ?></a>
                                            </h4>
                                        </div>
                                        <div id="<?= $itemClasse["class_id"]; ?>" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <table class="table">
                                                    <?php foreach ($itemClasse["subclasses"] as $subItemClasse) { ?>
                                                        <tr>
                                                            <td class="first">
                                                                <a id="subItemClasse"
                                                                   data-sub-class-id="<?= $subItemClasse->subclass; ?>"
                                                                   class="subItemClasse clickable"><?= $subItemClasse->name; ?></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input style="display: none" class="form-control" id="filterNameShop" type="text"
                                   placeholder="Name or Race">
                            <ul class="list-group" id="filterNameListShop">
                                <div id="shopDisplayItems"></div>
                            </ul>
                        </div>
                    </div>
                </div>

                <br class="clear">

            </article>
            <!-- /article -->

        <?php endwhile; ?>

        <?php else: ?>
            <!-- article -->
            <article>

                <h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>

            </article>
            <!-- /article -->
        <?php endif; ?>

    </section>
    <!-- /section -->
</main>

<div id="shopModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php get_sidebar(); ?>

<script>
    function showFilterShop() {
        $("#filterNameShop").show();
    }

    function hideFilterShop() {
        $("#filterNameShop").hide();
    }

    function showMoreShop($this) {
        $("*").addClass("progressWait");
        var id = JSON.parse($($this).attr('data-show')).id;
        var value = JSON.parse($($this).attr('data-show')).value;
        $.post("/api/shop/shop.php",
            {
                id: id,
                item_id: value,
                item_set_id: value
            },
            function (data, status) {
                $("*").removeClass("progressWait");
                if (status === "success") {
                    var modal = $('#shopModal');
                    $(modal).modal('show');
                    var modalHeader = $(modal).find('.modal-title');
                    var modalContent = $(modal).find('.modal-body');
                    $(modalHeader).html("");
                    $(modalContent).html(data);
                }
            });
    }

    $("a.subItemClasse").click(function (e) {
        $("*").addClass("progressWait");
        var classId = $(e.target).parent().parent().parent().parent().parent().parent().attr("id");
        $.post("/api/shop/shop.php",
            {
                id: $(e.target).attr('id'),
                subClassId: $(e.target).attr('data-sub-class-id'),
                classId: classId
            },
            function (data, status) {
                $("*").removeClass("progressWait");
                if (data !== 'Error !' && data !== 'No Result !') {
                    showFilterShop();
                    $("#shopDisplayItems").html(data);
                } else {
                    hideFilterShop();
                    $("#shopDisplayItems").html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>' + data + '</strong></div>');
                }
            });
    });

    $(document).ready(function () {
        $("#filterNameShop").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#filterNameListShop li").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<?php get_footer(); ?>

