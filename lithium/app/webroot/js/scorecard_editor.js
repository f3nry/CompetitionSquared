/**
 * Competition Squared: your competition, simplified
 *
 * Copyright (C) 2010  Paul Henry
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

var counter = 0;
var inEdit = false;

$(document).ready(function(){
    $("#action-table").find('tbody').bind('mouseleave', function(e){
        var newPageX = e.pageX + 1;
        var newPageY = e.pageY + 1;
        var isInHoverMenuX = (newPageX > $("#hovermenu").offset().left && newPageX < $("#hovermenu").offset().left + $("#hovermenu").width());
        var isInHoverMenuY = (newPageY > $("#hovermenu").offset().top && newPageY < $("#hovermenu").offset().top + $("#hovermenu").height());

        if(!(isInHoverMenuX && isInHoverMenuY) && !inEdit) {
            $("#hovermenu").hide();
        }
    });

    $("#action-table tr.row").each(function(index, value) {
            $(value).hover(function() {
                    if(!inEdit) {
                        reAlignHoverMenu(value);

                        $("#hovermenu_edit").attr("href", $(value).attr('id'));
                        $("#hovermenu_delete").attr("href", $(value).attr('id'));
                    }
            });
            counter = counter + 1;
        });

    $("#hovermenu").bind('mouseleave', function(e){
        var newPageX = e.pageX + 1;
        var newPageY = e.pageY + 1;
        var isInActionTableX = (newPageX > $("#action-table").offset().left && newPageX < $("#action-table").offset().left + $("#action-table").width());
        var isInActionTableY = (newPageY > $("#action-table").offset().top && newPageY < $("#action-table").offset().top + $("#action-table").height());

        if(!(isInActionTableX && isInActionTableY) && !inEdit) {
            $("#hovermenu").hide();
        }
    });

    $("#hovermenu_edit").bind('click',
        function() {
            var e = $("#" + $("#hovermenu_edit").attr("href") + "_action");
            $(e).html($("<textarea>").attr('cols', '30').attr('rows', '10').text(e.html()));

            e = $("#" + $("#hovermenu_edit").attr("href") + "_points");
            $(e).html($("<textarea>").attr('cols', '30').attr('rows', '10').text(e.html()));

            $("#hovermenu_edit").hide();
            $("#hovermenu_save").show();
            $("#hovermenu_save").attr('href', $("#hovermenu_edit").attr('href'));

            inEdit = true;

            reAlignHoverMenu($("#" + $("#hovermenu_edit").attr("href")));

            return false;
        });

    $("#hovermenu_save").bind('click',
        function() {
            var e = $("#" + $("#hovermenu_edit").attr("href") + "_action");
            $(e).html(e.find('textarea').val());

            e = $("#" + $("#hovermenu_edit").attr("href") + "_points");
            $(e).html(e.find('textarea').val());

            $("#hovermenu_edit").show();
            $("#hovermenu_save").hide();

            inEdit = false;

            return false;
        });

    $("#hovermenu_delete").bind('click',
        function() {
            if(confirm('Are you sure you want to delete that?')) {
                $("#" + $("#hovermenu_edit").attr("href")).remove();
                counter -= 1;

                reIndexTable();
            }

            return false;
        });

    $("#add-action").bind('click',
        function() {
            var tr = $('<tr>');
            tr.attr('id', 'field_' + counter);

            tr.append(
                $('<td>').attr('id', 'field_' + counter + '_action').html($('#action').val())
            );
            tr.append(
                $('<td>').attr('id', 'field_' + counter + '_points').html($('#points').val())
            );

            var select = $('<select>');
            select.attr('name', 'field_' + counter + '_type');

            var option = $('<option>').attr('value', 'TEXT').html('Displayed Score');

            if($("#type").val() == "TEXT") {
                option.attr('selected', 'selected');
            }

            select.append(option);

            option = $('<option>').attr('value', 'HIDDEN').html('Non-Displayed Score');

            if($("#type").val() == "HIDDEN") {
                option.attr('selected', 'selected');
            }

            select.append(option);

            tr.append($('<td>').append(select));
            
            tr.append($('<td>')
                .attr('id', 'field_' + counter + '_input')
                .attr('style', 'text-align:right')
                .append($('<input>')
                    .attr('type', 'text')
                    .attr('value', '0')
                    .attr('size', 6)
                    .attr('disabled', 'disabled')
                    )
                );

            if(counter % 2 == 0) {
                tr.attr('bgcolor', '#DCDCDC');
            }

            tr.hover(function() {
                    if(!inEdit) {
                        reAlignHoverMenu(this);
                        
                        $("#hovermenu_edit").attr("href", tr.attr('id'));
                        $("#hovermenu_delete").attr("href", tr.attr('id'));
                    }
                });

            if(counter != 0) {
                $("#action-table #field_" + (counter - 1)).after(tr);
            } else {
                $("#action-table").append(tr);
            }

            counter = counter + 1;
        }
        );

    $("#scorecard-form").submit(
        function() {
            if($("#name").val() == "") {
                alert("You must enter a name.");
                return false;
            }

            if($("#action-table").find("tr").length > 1) {
                for(var i = 0; i < counter; i++) {
                    var el = $("#field_" + i);
                    if(el) {
                        if($(el).attr('id') != "") {
                            var field_action = $("<textarea>");
                            field_action.attr("name", "field_" + (i) + "_action");
                            field_action.val($("#field_" + (i) + "_action").html());
                            $("#field_" + (i) + "_action").html(field_action);

                            var field_points = $("<textarea>");
                            field_points.attr("name", "field_" + (i) + "_points");
                            field_points.val($("#field_" + (i) + "_points").html());
                            $("#field_" + (i) + "_points").html(field_points);
                        }
                    }
                }
            } else {
                alert("You must have at least one action.");
                return false;
            }

            return true;
        }
        );

    $("#scorecard-submit").bind('click',
        function() {
            var form = $("<form>");
            form.attr("method", "post");
            form.attr("action", "admin/scorecards/add");

            if($("#name").val() == "") {
                alert("You must enter a name.");
                return;
            }
            
            var name = $("<input>");
            name.attr("type", "text");
            name.attr("name", "name");
            name.val($("#name").val());
            form.append(name);

            var total = $("<input>");
            total.attr("type", "text");
            total.attr("name", "total");
            total.val(counter);
            form.append(total);

            if($("#action-table").find("tr").length > 1) {
                $("#action-table").find("tr").each(
                    function(i, el) {
                        if($(el).attr('id') != "") {
                            var field_action = $("<input>");
                            field_action.attr("type", "text");
                            field_action.attr("name", "field_" + (i - 1) + "_action");
                            field_action.val($("#field_" + (i - 1) + "_action").text());
                            form.append(field_action);

                            var field_points = $("<input>");
                            field_points.attr("type", "text");
                            field_points.attr("name", "field_" + (i - 1) + "_points");
                            field_points.val($("#field_" + (i - 1) + "_points").text());
                            form.append(field_points);
                        }
                    }
                    );
            } else {
                alert("You must have at least one action.");
                return;
            }
        }
        );
});

function reIndexTable() {
    $('#action-table').find('tr').each(
        function(i, el) {
            if($(el).attr('id') != "") {
                $(el).attr('id', 'field_' + (i - 1));

                if((i + 1) % 2 == 0) {
                    $(el).attr('bgcolor', '#DCDCDC')
                } else {
                    $(el).attr('bgcolor', '#FFF');
                }
            }
        }
        );
}

function reAlignHoverMenu(object) {
    var pTop = $(object).offset().top;
    var pLeft = $(object).offset().left + $(object).width() - $("#hovermenu").width();
    $("#hovermenu").css({
        top: pTop,
        left: pLeft
    }).show();
}