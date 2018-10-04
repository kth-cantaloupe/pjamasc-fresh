{extends file="layout.tpl"}

{block name="scripts"}
    <script src="assets/js/addReview.js"></script>
{/block}

{block name="body"}
    <div class="container">

        <div id="product-page" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h2>{$product->name|escape}</h2>
        </div>
        <img class="product-image" src="assets/images/products/{$product->id}.jpg" alt="Picture of product">

        <div class="product-description">
            <p>
                {$product->description|escape}
            </p>
        </div>



        <div class="reviews">
            <h2>Reviews</h2>
            <hr>

            <div id="commentsContainer" class="comments">
                {foreach from=$reviews item=review}
                <div class="comment">
                    <div class="comment-user">
                        <img class="comment-user-pic" src="assets/images/profile-pic.png" alt="User picture">
                        <img class="comment-stars" src="assets/images/stars/{$review->rating}-stars.png" alt="stars">
                        <h3>{$review->author->name|escape}</h3>
                        <h4>{$review->creation|escape}</h4>
                    </div>
                    <p>{$review->comment|escape}</p>
                    <hr>
                </div>
                {/foreach}
            </div>

            {if Authentication::customer() == true}
            <div class="comment-form form-group">
                <form id="reviewForm" action="" method="post">
                    <input type="hidden" id="reviewProduct" value="{$product->id}"/>
                    <input type="hidden" id="reviewAuthorId" value="{Authentication::user()->id}"/>
                    <input type="hidden" id="reviewAuthorName" value="{Authentication::user()->name}"/>
                    <label for="stars">Select number of stars:</label>
                    <select name="stars" id="select-stars" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                    <input type="submit" value="Post review"/>
                </form>
            </div>
            {/if}

        </div>


    </div>
{/block}
