<%@ Page Language="C#" %>

<%@ Import Namespace="System.IO" %>
<%@ Import Namespace="System.Text" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="System.Data.SqlClient" %>
<%@ Import Namespace="System.Data.Odbc" %>
<%@ Import Namespace="System.Web" %>
<%@ Import Namespace="System.Web.UI.WebControls" %>
<%@ Import Namespace="System.Collections.Generic" %>
<%@ Import Namespace="System.Drawing" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<script runat="server">

    static string conS = "";
    #region DatabaseConnect
    private DataTable selectall(string query)
    {
        SqlConnection con = new SqlConnection(conS);
        SqlCommand cmd = new SqlCommand();
        cmd.CommandType = CommandType.Text;
        cmd.CommandText = query;
        //
        cmd.Connection = con;
        SqlDataAdapter da = new SqlDataAdapter();
        DataSet ds = new DataSet();
        da.SelectCommand = cmd;
        da.Fill(ds);
        //
        ViewState["DataTable"] = ds.Tables[0];
        //
        return ds.Tables[0];
    }
    //
    private void IUD(string query)
    {

        SqlConnection con = new SqlConnection(conS);
        SqlCommand cmd = new SqlCommand();
        cmd.CommandType = CommandType.Text;
        cmd.CommandText = query;
        //
        cmd.Connection = con;
        con.Open();
        cmd.ExecuteNonQuery();
        con.Close();
    }

    #endregion
    //
    #region functions

    private void FillGV()
    {

        //lblExeQuery.Visible = false;
        //  GV.Columns[1].Visible = false;
        //GV.Columns[0].Visible = true;
        //

        if (ViewState["tblName"] != null && ViewState["exec"] == null)
        {
            try
            {
                string TableName = ViewState["tblName"].ToString();
                GV.DataSource = selectall("SELECT * FROM " + TableName);
                GV.DataBind();
                //
                GV.Columns[1].Visible = true;
                GV.Columns[0].Visible = false;
                //
                lblExeQuery.Visible = false;
                lblMessage.Visible = false;
            }
            catch (Exception ex)
            {
                lblExeQuery.Text = "Error in the query.. Check details below";
                lblMessage.Text = ex.ToString();
                lblExeQuery.Visible = true;
                lblMessage.Visible = true;
            }
        }
        else if (ViewState["exec"] != null && ViewState["tblName"] == null)
        {
            try
            {
                string query = ViewState["exec"].ToString();
                if (query.ToLower().StartsWith("select"))
                {
                    GV.DataSource = selectall(query);
                    GV.DataBind();
                    //
                    GV.Columns[1].Visible = true;
                    GV.Columns[0].Visible = false;
                    //
                    lblExeQuery.Text = "Query has been executed successful";
                    lblExeQuery.Visible = true;
                    lblMessage.Visible = false;
                }
                else
                {
                    IUD(query);
                    lblExeQuery.Text = "Query has been executed successful";
                    lblExeQuery.Visible = true;
                    lblMessage.Visible = false;
                }
            }
            catch (Exception ex)
            {
                lblExeQuery.Text = "Error in the query.. Check details below";
                lblMessage.Text = ex.ToString();
                lblExeQuery.Visible = true;
                lblMessage.Visible = true;
            }
        }
        else
        {
            try
            {
                string db = Session["db"].ToString();
                GV.DataSource = selectall("SELECT name as 'Table Name',create_date as 'Create Date',modify_date as 'Modify Date' FROM " + db + ".sys.Tables");
                GV.DataBind();
                //
                GV.Columns[1].Visible = false;
                GV.Columns[0].Visible = true;
                //
                Session["isLogin"] = "yes";
                //
                lblExeQuery.Visible = false;
                lblMessage.Visible = false;
            }
            catch (Exception ex)
            {
                InValid();
                Session["isLogin"] = "no";
            }
        }
    }
    //
    public void InValid()
    {
        pnlQuery.Visible = false;
        lblMessage.Text = "Invalid Data .. Check your Settings";
        lblMessage.Visible = true;
        pnlLogin.Visible = true;
        pnlGrd.Visible = false;
    }

    #endregion
    //
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            if (Session["isLogin"] == null || Session["isLogin"].ToString().ToLower() == "no")
            {
                pnlQuery.Visible = false;
                lblMessage.Visible = false;
                pnlLogin.Visible = true;
                pnlGrd.Visible = false;
            }
            else
            {
                pnlQuery.Visible = true;
                lblMessage.Visible = false;
                pnlLogin.Visible = false;
                pnlGrd.Visible = true;
                //
                FillGV();
            }
        }
    }
    //
    protected void GV_SelectedIndexChanging(object sender, GridViewSelectEventArgs e)
    {
        string tblName = GV.Rows[e.NewSelectedIndex].Cells[2].Text;
        ViewState["tblName"] = tblName;
        ViewState["exec"] = null;
        FillGV();
    }
    //
    protected void GV_RowEditing(object sender, GridViewEditEventArgs e)
    {


        GV.EditIndex = e.NewEditIndex;
        //
        List<UpdateData> data = new List<UpdateData>();
        //
        DataTable dt = (DataTable)ViewState["DataTable"];
        //
        //
        for (int i = 2; i < GV.Rows[e.NewEditIndex].Cells.Count; i++)
        {
            string value = GV.Rows[e.NewEditIndex].Cells[i].Text;
            //
            data.Add(new UpdateData(dt.Columns[i - 2].ColumnName, value));
        }
        //
        string where = "";
        //
        foreach (UpdateData UD in data)
        {

            where += UD.columnName + "='" + UD.value + "',";
        }
        //
        where = where.Remove(where.LastIndexOf(",")).Replace(",", " and ");
        //
        ViewState["where"] = where;
        //
        //
        FillGV();
    }
    //
    protected void GV_RowCancelingEdit(object sender, GridViewCancelEditEventArgs e)
    {
        GV.EditIndex = -1;
        FillGV();
    }
    //
    protected void GV_PageIndexChanging(object sender, GridViewPageEventArgs e)
    {
        GV.PageIndex = e.NewPageIndex;
        FillGV();

    }
    //
    protected void Btn_DataTables_Click(object sender, EventArgs e)
    {
        ViewState["tblName"] = null;
        ViewState["exec"] = null;
        FillGV();
    }
    //
    protected void btnConect_Click(object sender, EventArgs e)
    {
        pnlQuery.Visible = true;
        lblMessage.Visible = false;
        pnlGrd.Visible = true;
        pnlLogin.Visible = false;
        //
        string username = txtBxLogin.Text.Replace("'", "").Trim();
        string pass = txtBxPassword.Text.Replace("'", "").Trim();
        string server = txtBxServer.Text.Replace("'", "").Trim();
        Session["db"] = txtBxDatabase.Text.Replace("'", "").Trim();
        //

        if (ddlAuth.SelectedValue.ToLower() == "sql")
            conS = @"Data Source='" + server + "';Initial Catalog='" + Session["db"].ToString() + "';User Id='" + username + "';Password='" + pass + "'";
        else
            conS = @"Data Source='" + server + "';Initial Catalog='" + Session["db"].ToString() + "';Integrated Security=True";
        //
        ViewState["tblName"] = null;
        ViewState["exec"] = null;
        //
        FillGV();
    }

    protected void BtnLogout_Click(object sender, EventArgs e)
    {
        Session["isLogin"] = null;
        Response.Redirect(Request.Path);
    }
    //
    protected void btnExecute_Click(object sender, EventArgs e)
    {
        ViewState["exec"] = txtQuery.Text.Trim();
        ViewState["tblName"] = null;
        FillGV();
    }

    protected void GV_RowUpdating(object sender, GridViewUpdateEventArgs e)
    {
        List<UpdateData> data = new List<UpdateData>();
        //
        DataTable dt = (DataTable)ViewState["DataTable"];
        //
        //
        for (int i = 3; i < GV.Rows[e.RowIndex].Cells.Count; i++)
        {
            string value = ((TextBox)GV.Rows[e.RowIndex].Cells[i].Controls[0]).Text;
            //
            data.Add(new UpdateData(dt.Columns[i - 2].ColumnName, value));
        }
        //
        string query = "Update " + ViewState["tblName"].ToString() + " set ";
        //
        string clmn = "";
        //
        foreach (UpdateData UD in data)
        {

            clmn += UD.columnName + "='" + UD.value + "',";
        }
        //

        //
        query = query + clmn.Remove(clmn.LastIndexOf(",")) + " where " + ViewState["where"].ToString();
        //
        IUD(query);
        //
        GV.EditIndex = -1;
        FillGV();
    }
    //
    class UpdateData
    {
        public string columnName;
        public string value;
        //
        public UpdateData(string _columnName, string _value)
        {
            columnName = _columnName;
            value = _value;
        }
    }

    protected void ddlAuth_SelectedIndexChanged(object sender, EventArgs e)
    {
        if (ddlAuth.SelectedValue == "win")
            pnlSql.Visible = false;
        else
            pnlSql.Visible = true;
    }
</script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>MSSQL|1sT-Cmd V1.0</title>
    <style type="text/css">
        .style1
        {
            width: 104px;
            text-align: left;
        }
        .style2
        {
            font-size: x-large;
        }
        .style3
        {
            width: 645px;
        }
        .style4
        {
            width: 323px;
        }
        .style5
        {
            color: #FFFFFF;
            font-weight: bold;
            font-size: 8pt;
            font-family: Arial, Helvetica, sans-serif;
        }
        .style6
        {
            font-size: 8pt;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        .style7
        {
            color: #FFFFFF;
        }
        .style8
        {
            text-decoration: none;
        }
    </style>
</head>
<body style="background-color: InactiveCaptionText">
    <form id="form1" runat="server">
    <%--<asp:ScriptManager ID="ScriptManager1" runat="server">
    </asp:ScriptManager>--%>
    <div>
         <%--<asp:UpdatePanel ID="UpdatePanel11" runat="server">
            <ContentTemplate>--%>
        <table style="text-align: center">
            <tr>
                <td>
                    <asp:Panel ID="pnlQuery" runat="server" Style="text-align: left;" Width="980px">
                        <table>
                            <tr>
                                <td bgcolor="#999966" style="text-align: left" class="style3">
                                    <asp:Label ID="Label1" runat="server" Font-Bold="True" ForeColor="White" Text="Query: "></asp:Label>
                                    &nbsp;<asp:TextBox ID="txtQuery" runat="server" Width="500px"></asp:TextBox>&nbsp;<asp:RequiredFieldValidator
                                        ID="RequiredFieldValidator5" runat="server" ControlToValidate="txtQuery" Display="Dynamic"
                                        ErrorMessage="*" ValidationGroup="query"></asp:RequiredFieldValidator><asp:Button
                                            ID="btnExecute" runat="server" Text="Execute" ValidationGroup="query" OnClick="btnExecute_Click" />
                                </td>
                                <td class="style4">
                                    <asp:Label ID="lblExeQuery" runat="server" Font-Bold="True" ForeColor="White" Text="Query has been executed successful"
                                        Visible="False" Font-Size="11pt"></asp:Label>
                                </td>
                            </tr>
                        </table>
                    </asp:Panel>
                </td>
            </tr>
            <tr>
                <td>
                    <asp:Panel ID="pnlGrd" runat="server" Style="text-align: left;" Width="1200px">
                        <table>
                            <tr>
                                <td>
                                    <asp:GridView ID="GV" runat="server" BackColor="White" BorderColor="#999999" BorderStyle="Solid"
                                        BorderWidth="1px" CellPadding="3" ForeColor="Black" OnSelectedIndexChanging="GV_SelectedIndexChanging"
                                        OnRowEditing="GV_RowEditing" OnRowCancelingEdit="GV_RowCancelingEdit" OnPageIndexChanging="GV_PageIndexChanging"
                                        AllowPaging="True" PageSize="20" EmptyDataText="No Data Found" OnRowUpdating="GV_RowUpdating">
                                        <RowStyle Font-Size="10pt" Wrap="True" />
                                        <Columns>
                                            <asp:CommandField ShowSelectButton="True" />
                                            <asp:CommandField ShowEditButton="True" />
                                        </Columns>
                                        <FooterStyle BackColor="#CCCCCC" />
                                        <PagerStyle BackColor="#999999" ForeColor="Black" HorizontalAlign="Center" />
                                        <HeaderStyle BackColor="Black" Font-Bold="True" ForeColor="White" Font-Size="10pt" />
                                        <AlternatingRowStyle BackColor="#CCCCCC" />
                                    </asp:GridView>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <asp:Button ID="Btn_DataTables" runat="server" OnClick="Btn_DataTables_Click" Text="Tables List" />
                                    &nbsp;<asp:Button ID="BtnLogout" runat="server" OnClick="BtnLogout_Click" Text="Logout" />
                                </td>
                            </tr>
                        </table>
                    </asp:Panel>
                </td>
            </tr>
            <tr>
                <td style="height: 200px; text-align: center;">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <asp:Label ID="lblMessage" runat="server" Font-Bold="True" Font-Size="12pt" ForeColor="White"
                        Text="Invalid Data .. Check your Settings"></asp:Label>
                </td>
            </tr>
            <tr>
                <td>
                    <asp:Panel ID="pnlLogin" runat="server" Width="1250px">
                        <table align="center" style="width: 310px; border-style: outset; background-color: Gray">
                            <tr>
                                <th class="style2" colspan="2">
                                    Login
                                </th>
                            </tr>
                            <tr>
                                <td class="style1">
                                    Server Name
                                </td>
                                <td style="text-align: left">
                                    <asp:TextBox ID="txtBxServer" runat="server" Width="169px"></asp:TextBox>
                                    <asp:RequiredFieldValidator ID="RequiredFieldValidator1" runat="server" ControlToValidate="txtBxServer"
                                        Display="Dynamic" ErrorMessage="*" ValidationGroup="con"></asp:RequiredFieldValidator>
                                </td>
                            </tr>
                            <%-- <asp:UpdatePanel ID="UpdatePanel1" runat="server">
                                        <ContentTemplate>--%>
                            <tr>
                                <td class="style1">
                                    Authentication
                                </td>
                                <td style="text-align: left">
                                    <asp:DropDownList ID="ddlAuth" runat="server" Width="175px" AutoPostBack="True" OnSelectedIndexChanged="ddlAuth_SelectedIndexChanged">
                                        <asp:ListItem Selected="True" Value="sql">Sql Server Authentication</asp:ListItem>
                                        <asp:ListItem Value="win">Windows Authentication</asp:ListItem>
                                    </asp:DropDownList>
                                </td>
                            </tr>
                            <asp:Panel ID="pnlSql" runat="server">
                                <tr>
                                    <td class="style1">
                                        Login Name
                                    </td>
                                    <td style="text-align: left">
                                        <asp:TextBox ID="txtBxLogin" runat="server" Width="169px"></asp:TextBox>
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator2" runat="server" ControlToValidate="txtBxLogin"
                                            Display="Dynamic" ErrorMessage="*" ValidationGroup="con"></asp:RequiredFieldValidator>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="style1">
                                        Password
                                    </td>
                                    <td style="text-align: left">
                                        <asp:TextBox ID="txtBxPassword" runat="server" Width="169px" ValidationGroup="con"></asp:TextBox>
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator3" runat="server" ControlToValidate="txtBxPassword"
                                            Display="Dynamic" ErrorMessage="*" ValidationGroup="con"></asp:RequiredFieldValidator>
                                    </td>
                                </tr>
                            </asp:Panel>
                            <%--</ContentTemplate>
                                    </asp:UpdatePanel>--%>
                            <tr>
                                <td class="style1">
                                    Database Name
                                </td>
                                <td style="text-align: left">
                                    <asp:TextBox ID="txtBxDatabase" runat="server" Width="169px"></asp:TextBox>
                                    <asp:RequiredFieldValidator ID="RequiredFieldValidator4" runat="server" ControlToValidate="txtBxDatabase"
                                        Display="Dynamic" ErrorMessage="*" ValidationGroup="con"></asp:RequiredFieldValidator>
                                </td>
                            </tr>
                            <tr>
                                <td class="style1">
                                    &nbsp;
                                </td>
                                <td style="text-align: center">
                                    <asp:Button ID="btnConect" runat="server" OnClick="btnConect_Click" Text="Connect"
                                        ValidationGroup="con" />
                                </td>
                            </tr>
                        </table>
                    </asp:Panel>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    <span class="style6"><span class="style7">MSSQL|1sT-Cmd V1.0</span>&nbsp; Developed By
                    </span><span class="style5"><a class="style8" href="mailto:cyb3r-1st@hotmail.com"><span
                        class="style7">Cyb3r-1sT</span></a></span><span class="style6"> © 2011</span>
                </td>
            </tr>
        </table>
         <%--</ContentTemplate>
        </asp:UpdatePanel>--%>
    </div>
    </form>
</body>
</html>
