<!-- Start Grid Layout 1 Item -->
<article class="cbdb-grid-item">
    <!-- Post -->
    <div class="cbdb-grid-module">
        <!-- Thumbnail -->
        <div class="cbdb-grid-thumbnail">
            <?php
            // If a post image is enabled
            if (isset($cbdb_settings['cbdb_post_image']) && $cbdb_settings['cbdb_post_image']) {
                // If post date is enabled
                if (isset($cbdb_settings['cbdb_post_date']) && $cbdb_settings['cbdb_post_date']) {
                    $cbdb_date_class = '';
                    if (str_contains($cbdb_settings['cbdb_post_date_format'], ',')) {
                        $cbdb_date_class = 'commadate';
                    } elseif (str_contains($cbdb_settings['cbdb_post_date_format'], '-')) {
                        $cbdb_date_class = 'dashdate';
                    } elseif (str_contains($cbdb_settings['cbdb_post_date_format'], '/')) {
                        $cbdb_date_class = 'slashdate';
                    }
                    echo cbdb_post_date($cbdb_post_date_link, $cbdb_post_date_format, '', false, $cbdb_date_class);
                }
                if ($cbdb_post_media_size == 'custom') {
                    $cbdb_post_media_size = array($cbdb_add_custom_size_width, $cbdb_add_custom_size_height);
                }
                ?>
                <div class="cbdb-grid-image">
                    <?php
                    // If post image link enabled
                    if (isset($cbdb_settings['cbdb_post_image_link']) && $cbdb_settings['cbdb_post_image_link'] == 'yes') {
                        ?>
                        <a href="<?php echo esc_url(get_the_permalink()); ?>">
                            <?php
                        }
                        if (has_post_thumbnail()) {
                            // Display a post thumbnail
                            the_post_thumbnail($cbdb_post_media_size);
                        } else {
                            // Display a post placeholder
                            echo cbdb_get_placeholder_post_image($cbdb_post_media_size);
                        }
                        // If post image link enabled
                        if (isset($cbdb_settings['cbdb_post_image_link']) && $cbdb_settings['cbdb_post_image_link'] == 'yes') {
                            ?>
                        </a>
                    <?php } ?>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- Post Content-->
        <div class="cbdb-grid-content">
            <?php
            // If a post image is enabled
            if (isset($cbdb_settings['cbdb_post_image']) && $cbdb_settings['cbdb_post_image']) {
                // If post category is enabled
                if (isset($cbdb_settings['cbdb_post_cat']) && $cbdb_settings['cbdb_post_cat']) {
                    echo cbdb_posted_categories($cbdb_post_id, $cbdb_post_cat_link, '|', false);
                }
            } else {
                // If a post image is disabled
                ?>
                <div class="cbdb-no-image">
                    <?php
                    // If post category is enabled
                    if (isset($cbdb_settings['cbdb_post_cat']) && $cbdb_settings['cbdb_post_cat']) {
                        echo cbdb_posted_categories($cbdb_post_id, $cbdb_post_cat_link, '|', false);
                    }

                    // If post date is enabled
                    if (isset($cbdb_settings['cbdb_post_date']) && $cbdb_settings['cbdb_post_date']) {
                        $cbdb_date_class = '';
                        if (str_contains($cbdb_settings['cbdb_post_date_format'], ',')) {
                            $cbdb_date_class = 'commadate';
                        } elseif (str_contains($cbdb_settings['cbdb_post_date_format'], '-')) {
                            $cbdb_date_class = 'dashdate';
                        } elseif (str_contains($cbdb_settings['cbdb_post_date_format'], '/')) {
                            $cbdb_date_class = 'slashdate';
                        }
                        echo cbdb_post_date($cbdb_post_date_link, $cbdb_post_date_format, '', false, $cbdb_date_class);
                    }
                    ?>
                </div>
                <?php
            }

            // If post title is enabled
            if (isset($cbdb_settings['cbdb_post_title']) && $cbdb_settings['cbdb_post_title']) {
                echo cbdb_post_title_tag($cbdb_post_title_tag, $cbdb_post_title_link, $cbdb_post_title_open_link, $cbdb_custom_title_class_name);
            }

            // If read more is enabled
            if (isset($cbdb_settings['cbdb_read_more']) && $cbdb_settings['cbdb_read_more']) {
                $cbdb_read_more = ' <a href="' . esc_url(get_permalink()) . '" target="' . esc_attr($cbdb_read_more_open_link) . '" class="cbdb-read-more">' . esc_html__($cbdb_read_more_text, CRUD_TEXTDOMAIN) . '</a>';
            }
            // If post content is enabled
            if (isset($cbdb_settings['cbdb_post_content']) && $cbdb_settings['cbdb_post_content']) {
                ?> 
                <p class="cbdb-description <?php esc_attr_e($cbdb_custom_content_class_name); ?>">
                    <?php echo wp_trim_words($cbdb_content, $cbdb_post_content_length, $cbdb_read_more); ?>
                </p>
                <?php
            }

            // If post meta is enabled and meta exists
            $cbdb_posted_by = cbdb_posted_by('icon');
            // If post tag is enabled and tag exists
            $cbdb_posted_tags = cbdb_posted_tags($cbdb_post_id, $cbdb_post_tag_link, ',', true);
            if ((isset($cbdb_settings['cbdb_post_meta']) && $cbdb_settings['cbdb_post_meta'] && !empty($cbdb_posted_by)) || (isset($cbdb_settings['cbdb_post_tag']) && $cbdb_settings['cbdb_post_tag'] && !empty($cbdb_posted_tags))) {
                ?>
                <div class="cbdb-grid-meta-tag">
                    <?php
                    if (isset($cbdb_settings['cbdb_post_meta']) && $cbdb_settings['cbdb_post_meta'] && !empty($cbdb_posted_by)) {
                        echo $cbdb_posted_by;
                    }
                    if (isset($cbdb_settings['cbdb_post_meta']) && $cbdb_settings['cbdb_post_meta']) {
                        cbdb_comment_count();
                    }
                    if (isset($cbdb_settings['cbdb_post_tag']) && $cbdb_settings['cbdb_post_tag'] && !empty($cbdb_posted_tags)) {
                        echo $cbdb_posted_tags;
                    }
                    ?>
                </div>
                <?php
            }

            // If social share is enabled
            if (isset($cbdb_settings['cbdb_social_share_icon']) && $cbdb_settings['cbdb_social_share_icon']) {
                echo cbdb_social_share($cbdb_social_share_style);
            }
            ?>
        </div>
    </div> 
</article>
<!-- End Grid Layout 1 Item -->