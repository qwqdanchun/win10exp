<?php
wp_enqueue_media();
global $theme_option;
?>
    <link href="<?php echo get_stylesheet_directory_uri() . '/static/css/theme-options.css?5assr41' ?>"
          type="text/css"
          rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri() . '/static/layui/css/layui.css' ?>" type="text/css"
          rel="stylesheet">

    <div class="theme-set-main">

    <h2>功能选项</h2>
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li>SEO设置</li>
            <li>外观设置</li>
            <li>可用组件</li>
            <li>主页设置</li>
            <li class="layui-this">关于主题</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item">
                <div class="layui-form theme-set-from" action="">
                    <div class="layui-form-item">
                        <div class="theme-set-title">SEO总开关</div>
                        <div class="theme-set-control">
                            <?php

                            if ($theme_option['seo'] == 1) {
                                $checked = 'checked';

                            } else {
                                $checked = '';
                            }
                            ?>
                            <input class="" type="checkbox" name="seo" lay-skin="switch" lay-filter="switch-seo"
                                   lay-text="开启|关闭" <?php echo $checked ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="theme-set-title">文章页面自动设置SEO</div>
                        <div class="theme-set-control">
                            <?php

                            if ($theme_option['autoseo'] == 1) {
                                $checked = 'checked';
                            } else {
                                $checked = '';
                            }
                            ?>
                            <input class="" type="checkbox" name="autoseo" lay-skin="switch"
                                   lay-filter="switch-autoseo"
                                   lay-text="开启|关闭" <?php echo $checked ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="theme-set-title">首页标题</div>
                        <div class="theme-set-control">
                            <input type="text" name="index-title" class="theme-set-input"
                                   value="<?php echo $theme_option['index_title'] ?>" disabled>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="theme-set-title">网站标题</div>
                        <div class="theme-set-control">
                            <input type="text" name="site-name" class="theme-set-input"
                                   value="<?php echo $theme_option['site_name'] ?>" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="theme-set-title">网站描述</div>
                        <div class="theme-set-control">
                            <textarea name="site-description" class="layui-textarea"
                                      disabled><?php echo $theme_option['site_description'] ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="theme-set-title">网站关键字</div>
                        <div class="theme-set-control">
                            <textarea name="site-key" class="layui-textarea"
                                      disabled><?php echo $theme_option['site_key'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-tab-item">

                <div class="layui-form">
                    <div class="layui-form-item">
                        <div class="theme-set-title">自定义网站标题前小图标(建议16x16的倍数)</div>
                        <div class="theme-set-control">
                            <input type="text" name="title-icon" class="theme-set-input"
                                   value="<?php echo $theme_option['title_icon'] ?>">
                            <button class="layui-btn layui-btn-normal" onclick="upimg('title-icon')">选择图片</button>
                            <img src="<?php echo $theme_option['title_icon'] ?>" alt="" width="38" height="38">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="theme-set-title">自定义文章列表前小图标(建议16x16的倍数)</div>
                        <div class="theme-set-control">
                            <input type="text" name="single-icon" class="theme-set-input"
                                   value="<?php echo $theme_option['single_icon'] ?>">
                            <button class="layui-btn layui-btn-normal" onclick="upimg('single-icon')">选择图片</button>
                            <img src="<?php echo $theme_option['single_icon'] ?>" alt="" width="38" height="38">
                        </div>
                    </div>

                </div>
            </div>
            <div class="layui-tab-item">
                <h3>本主题自带layui字体和awesome字体</h3>
                <p>可用在网页任意地方调用字体图标，样式浏览见下面地址</p><br>
                <a href="https://www.layui.com/doc/element/icon.html" class="layui-btn layui-btn-normal"
                   target="_blank"><i class="layui-icon layui-icon-link"></i>layui字体图标</a>
                <a href="http://fontawesome.dashgame.com/" class="layui-btn layui-btn-normal" target="_blank"><i
                            class="layui-icon layui-icon-link"></i>awesome字体图标</a>
                <hr>
            </div>
            <div class="layui-tab-item">
                <div class="layui-form theme-set-from" action="">

                    <div class="layui-form-item">
                        <div class="theme-set-title">3D 对象</div>
                        <div class="theme-set-control">
                            <input type="text" name="folder_3D_Objects" class="theme-set-input"
                                   value="<?php echo $theme_option['folder_3D_Objects'] ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="theme-set-title">视频</div>
                        <div class="theme-set-control">
                            <input type="text" name="folder_Videos" class="theme-set-input"
                                   value="<?php echo $theme_option['folder_Videos'] ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="theme-set-title">图片</div>
                        <div class="theme-set-control">
                            <input type="text" name="folder_Pictures" class="theme-set-input"
                                   value="<?php echo $theme_option['folder_Pictures'] ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="theme-set-title">文档</div>
                        <div class="theme-set-control">
                            <input type="text" name="folder_Documents" class="theme-set-input"
                                   value="<?php echo $theme_option['folder_Documents'] ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="theme-set-title">下载</div>
                        <div class="theme-set-control">
                            <input type="text" name="folder_Download" class="theme-set-input"
                                   value="<?php echo $theme_option['folder_Download'] ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="theme-set-title">音乐</div>
                        <div class="theme-set-control">
                            <input type="text" name="folder_Music" class="theme-set-input"
                                   value="<?php echo $theme_option['folder_Music'] ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="theme-set-title">桌面</div>
                        <div class="theme-set-control">
                            <input type="text" name="folder_Desktop" class="theme-set-input"
                                   value="<?php echo $theme_option['folder_Desktop'] ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="theme-set-title">最近文章</div>
                        <div class="theme-set-control">
                            <input type="text" name="folder_Articals" class="theme-set-input"
                                   value="<?php echo $theme_option['folder_Articals'] ?>">
                        </div>
                    </div>

                </div>
            </div>
            <div class="layui-tab-item layui-show">
                <h3> Win10资源管理器主题</h3>
                <br><br>
                <div class="layui-form-item">
                    <div class="theme-set-title">说明地址</div>
                    <div class="theme-set-control">
                        <a href="https://github.com/qwqdanchun/win10explore" target="_blank">https://github.com/qwqdanchun/win10explore</a>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="theme-set-title">当前版本：1.0 <p id="theme-version">最新版本：等待检查中</p></div>
                    <div class="theme-set-control">
                        <button class="layui-btn layui-btn-normal" onclick="clickversion()">检查更新</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="layui-btn-normal layui-btn" onclick="saveset()">保存配置</button>

    <script src="<?php echo get_stylesheet_directory_uri() . '/static/layui/layui.all.js' ?>"></script>
    <script>
        $ = jQuery;
        var form = layui.form;
        var switch_seo = <?php echo $theme_option['seo'];?>;
        var switch_autoseo = <?php echo $theme_option['seo'];?>;

        $(document).ready(function () {
            initset();
        });

        function initset() {
            if (switch_seo == 1) {
                $("input[name=index-title]").attr("disabled", false);
                $("textarea[name=site-description]").attr("disabled", false);
                $("textarea[name=site-key]").attr("disabled", false);
                $("input[name=autoseo]").attr("disabled", false);
                $("input[name=site-name]").attr("disabled", false);
                form.render();
            }
        }

        function upimg($data) {
            wp.media.editor.send.attachment = function (props, attachment) {
                $('input[name=' + $data + ']').val(attachment.url);
            }
            wp.media.editor.open();
        }

        function clickversion() {
            $('#theme-version').text('检查中');
            var data = {action: 'check_version'};
            $.get('<?php echo admin_url('admin-ajax.php');?>', data, function (data) {
                if (data !== 0) {
                    if (data !=='<?php echo THEME_VERSION?>') {
                        $('#theme-version').text('最新版本:' + data);
                    }
                } else {
                    $('#theme-version').text('获取失败');
                }
            });
        }

        function saveset() {
            var site_description = $("textarea[name=site-description]").val();
            var site_key = $("textarea[name=site-key]").val();
            var index_title = $("input[name=index-title]").val();
            var site_name = $("input[name=site-name]").val();
            var single_icon = $("input[name=single-icon]").val();
            var title_icon = $("input[name=title-icon]").val();
            var folder_3D_Objects = $("input[name=folder_3D_Objects]").val();
            var folder_Videos = $("input[name=folder_Videos]").val();
            var folder_Pictures = $("input[name=folder_Pictures]").val();
            var folder_Documents = $("input[name=folder_Documents]").val();
            var folder_Download = $("input[name=folder_Download]").val();
            var folder_Music = $("input[name=folder_Music]").val();
            var folder_Desktop = $("input[name=folder_Desktop]").val();
            var folder_Articals = $("input[name=folder_Articals]").val();
            var data = {
                action: 'save_set',
                seo: switch_seo,
                autoseo: switch_autoseo,
                site_description: site_description,
                site_key: site_key,
                index_title: index_title,
                site_name: site_name,
                title_icon: title_icon,
                single_icon: single_icon,
                folder_3D_Objects: folder_3D_Objects,
                folder_Videos: folder_Videos,
                folder_Pictures: folder_Pictures,
                folder_Documents: folder_Documents,
                folder_Download: folder_Download,
                folder_Music: folder_Music,
                folder_Desktop: folder_Desktop,
                folder_Articals: folder_Articals

            }
            $.post("<?php echo admin_url('admin-ajax.php');?>", data, function (data) {
                    if (data == 1) {
                        layer.msg('保存成功！')

                    } else {
                        layer.msg('保存失败！')
                    }
                }
            );

        };
        form.on('switch(switch-seo)', function (data) {
            var open = data.elem.checked;
            if (open == true) {
                $("input[name=index-title]").attr("disabled", false);
                $("textarea[name=site-description]").attr("disabled", false);
                $("input[name=autoseo]").attr("disabled", false);
                $("textarea[name=site-key]").attr("disabled", false);
                $("input[name=site-name]").attr("disabled", false);
                switch_seo = 1;
            } else {
                switch_seo = 0;
                $("input[name=index-title]").attr("disabled", true);
                $("textarea[name=site-description]").attr("disabled", true);
                $("textarea[name=site-key]").attr("disabled", true);
                $("input[name=autoseo]").attr("disabled", true);
                $("input[name=autoseo]").attr("checked", false);
                $("input[name=site-name]").attr("disabled", true);
            }
            form.render();
        });
        form.on('switch(switch-autoseo)', function (data) {
            var open = data.elem.checked;
            if (open == true) {

                switch_autoseo = 1;
            } else {
                switch_autoseo = 0;
            }
        });
    </script>


<?php
