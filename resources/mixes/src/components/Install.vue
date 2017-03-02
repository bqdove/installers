<script>
  export default {
  }
</script>
<template>
    <div class="install-wrap">
        <div class="install-header">
            <div class="container">
                <span>当前版本：beta 1</span>
            </div>
        </div>
        <div class="container">
            <div class="install-content">
                <div class="step-header">
                    <div class="step success">
                        <span>1</span>
                        <em>检测环境</em>
                    </div>
                    <div class="step error">
                        <span>2</span>
                        <em>设置数据</em>
                    </div>
                    <div class="step active">
                        <span>3</span>
                        <em>设置账户</em>
                    </div>
                    <div class="step">
                        <span>4</span>
                        <em>获取结果</em>
                    </div>
                </div>
                <div class="step-content">
                    <h1>填写设置基本数据项</h1>
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>您的网站名称</label>
                                    <input type="text" placeholder="admin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>选择数据库</label>
                                    <div class="btn-group">
                                        <label class="active"><input type="radio">PostgreSQL</label>
                                        <label><input type="radio">MySQL</label>
                                        <label><input type="radio">SQLite3</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>数据库地址</label>
                                    <input type="text" placeholder="admin">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>数据库用户名</label>
                                    <input type="text" placeholder="admin">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>数据库名</label>
                                    <input type="text" placeholder="admin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>账户</label>
                                    <input type="text" placeholder="admin">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>密码</label>
                                    <input type="text" placeholder="admin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit">安装</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-content">
                    <h1>填写账户设置</h1>
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>管理员邮箱</label>
                                    <input type="text" placeholder="admin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>账户</label>
                                    <input type="text" placeholder="admin">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>密码</label>
                                    <input type="text" placeholder="admin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit">安装</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>