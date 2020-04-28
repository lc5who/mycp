define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'lottery/lotteryt/index' + location.search,
                    add_url: 'lottery/lotteryt/add',
                    edit_url: 'lottery/lotteryt/edit',
                    del_url: 'lottery/lotteryt/del',
                    multi_url: 'lottery/lotteryt/multi',
                    table: 'opentime',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'lottery.name', title: __('Lottery.name')},
                        {field: 'qishu', title: __('Qishu')},
                        {field: 'kaipan', title: __('Kaipan')},
                        {field: 'fengpan', title: __('Fengpan')},
                        {field: 'kaijiang', title: __('Kaijiang')},

                        {field: 'csk', title: __('Csk')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});