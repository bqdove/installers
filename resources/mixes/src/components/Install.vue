<script>
  export default {
    data () {
      return {
        administration: {
          email: '',
          password: '',
          username: ''
        },
        database: {
          database: '',
          engine: 'postgres',
          host: 'localhost',
          password: '',
          username: 'root'
        },
        result: {
          administration: 'http://notadd.dev/admin',
          frontend: 'http://notadd.dev',
        },
        sitename: ''
      }
    }
  }
</script>
<template>
    <div class="install-wrap">
        <div class="install-header">
            <div class="container">
                <span>当前版本：beta 2</span>
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
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-12">
                                <div class="check-info">
                                    <div class="check-header">01</div>
                                    <div class="check-wrap">
                                        <div class="check-content">
                                            <p>这是一段成功信息！</p>
                                        </div>
                                        <div class="check-footer">
                                            <div class="check-status success">成功</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="check-info">
                                    <div class="check-header">02</div>
                                    <div class="check-wrap">
                                        <div class="check-content">
                                            <p>这是一段错误信息！</p>
                                        </div>
                                        <div class="check-footer">
                                            <div class="check-status error">失败</div>
                                            <div class="check-extend">
                                                <a href="https://notadd.com" class="error">错误原因</a>
                                                <span>|</span>
                                                <a href="https://notadd.com" class="help">获取帮助</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="check-info">
                                    <div class="check-header">03</div>
                                    <div class="check-wrap">
                                        <div class="check-content">
                                            <p>这是一段错误信息！</p>
                                        </div>
                                        <div class="check-footer">
                                            <div class="check-status error">失败</div>
                                            <div class="check-extend">
                                                <a href="https://notadd.com" class="error">错误原因</a>
                                                <span>|</span>
                                                <a href="https://notadd.com" class="help">获取帮助</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="check-info">
                                    <div class="check-header">04</div>
                                    <div class="check-wrap">
                                        <div class="check-content">
                                            <p>这是一段错误信息！</p>
                                        </div>
                                        <div class="check-footer">
                                            <div class="check-status error">失败</div>
                                            <div class="check-extend">
                                                <a href="https://notadd.com" class="error">错误原因</a>
                                                <span>|</span>
                                                <a href="https://notadd.com" class="help">获取帮助</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit">下一步</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-content">
                    <h1>填写设置基本数据项</h1>
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>您的网站名称</label>
                                    <input type="text" placeholder="请输入网站名称" v-model="sitename">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>选择数据库</label>
                                    <div class="btn-group">
                                        <label :class="{ active: database.engine === 'postgres' }"><input type="radio" name="database" value="postgres" v-model="database.engine">PostgreSQL</label>
                                        <label :class="{ active: database.engine === 'mysql' }"><input type="radio" name="database" value="mysql" v-model="database.engine">MySQL</label>
                                        <label :class="{ active: database.engine === 'sqlite' }"><input type="radio" name="database" value="sqlite" v-model="database.engine">SQLite3</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>数据库地址</label>
                                    <input type="text" placeholder="请输入数据库地址" v-model="database.host">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>数据库名称</label>
                                    <input type="text" placeholder="请输入数据库名称" v-model="database.database">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>数据库用户名</label>
                                    <input type="text" placeholder="请输入数据库用户名" v-model="database.username">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>数据库密码</label>
                                    <input type="text" placeholder="请输入数据库密码" v-model="database.password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit">下一步</button>
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
                                    <input type="text" placeholder="请输入管理员邮箱" v-model="administration.email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>账户</label>
                                    <input type="text" placeholder="请输入管理员账号" v-model="administration.username">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>密码</label>
                                    <input type="text" placeholder="请输入管理员密码" v-model="administration.password">
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
                    <h1 class="success">恭喜你！安装成功！</h1>
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>后台管理地址</label>
                                    <a :href="result.administration" target="_blank">{{ result.administration }}</a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>前台首页</label>
                                    <a :href="result.frontend" target="_blank">{{ result.frontend }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>账户</label>
                                    <input type="text" placeholder="未输入管理员账号" v-model="administration.username">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>密码</label>
                                    <input type="text" placeholder="未输入管理员密码" v-model="administration.password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>